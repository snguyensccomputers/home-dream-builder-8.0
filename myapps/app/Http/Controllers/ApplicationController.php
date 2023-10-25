<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationRegister;
use App\Models\User;

use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ApplicationController extends BaseController {

    protected $resource;
    protected $applicationRegister;
    protected $user;

    public function __construct(Application $resource, ApplicationRegister $applicationRegister, User $user) {
        $this->resource = $resource;
        $this->applicationRegister = $applicationRegister;
        $this->user = $user;
    }

    public function convertAnswersToJsonObj($inputs) {
        $fixedQuestions = DB::table('fixed_questions')->get();
        $questions = DB::table('questions')->get();

        $jsonQtoAObj = '{';

        foreach ($fixedQuestions as $question) {
            if ($question->active == 1) {
                $answer = $inputs[$question->tag];
                $jsonQtoAObj .= '"' . $question->tag . '":"' . $answer . '",';
            }
        }

        foreach ($questions as $question) {
            $answer = $inputs[$question->tag];
            $jsonQtoAObj .= '"' . $question->tag . '":"' . $answer . '",';
        }

        $jsonQtoAObj = substr($jsonQtoAObj, 0, -1);

        $jsonQtoAObj .= '}';

        return $jsonQtoAObj;
    }

    public function getJson($formId) {
        $resources = $this->resource->where('id', '=', $formId)->first();

        dd(json_decode($resources->questions_and_answers));
    }

    public function application() {
        $fixedQuestions = DB::table('fixed_questions')->get();
        $questions = DB::table('questions')->get();

        return view('application/application (v2)', array(
            'pageTitle' => 'Application',
            'pageDescription' => '',
            'pageKeywords' => '',
            'fixedQuestions' => $fixedQuestions,
            'questions' => $questions,
            'homeFeaturesList' => Application::initializeHomeFeatures()
        ));
    }

    public function savedDraft($formCode) {
        $resource = $this->resource->where('form_code', '=', $formCode)->first();
        $savedDraft = $this->applicationRegister->where('form_id', '=', $resource->id)->first();
        $user = $this->user->where('id', '=', $savedDraft->user_id)->first();

        $fixedQuestions = DB::table('fixed_questions')->get();
        $questions = DB::table('questions')->get();
        $questionsAndAnswers = json_decode($resource->questions_and_answers);

        $top10Features = array();
        $top10FeaturesTag = array();
        foreach (explode(',', $resource->top_10_features_tag) as $featureTag) {
            $feature = DB::select('SELECT * FROM (SELECT tag, question FROM fixed_questions UNION SELECT tag, question FROM questions) AS all_questions WHERE tag = ?', [$featureTag]);
            if (count($feature) > 0) {
                $feature = $feature[0];
                array_push($top10Features, $feature->question);
                array_push($top10FeaturesTag, $feature->tag);
            }
        }

        return view('application/saved-draft (v2)', array(
            'pageTitle' => 'Saved Application #' . $resource->id,
            'pageDescription' => '',
            'pageKeywords' => '',
            'homeFeaturesList' => Application::initializeHomeFeatures(),
            'user' => $user,
            'application' => $resource,
            'savedDraft' => $savedDraft,
            'fixedQuestions' => $fixedQuestions,
            'questions' => $questions,
            'questionsAndAnswers' => $questionsAndAnswers,
            'top10Features' => $top10Features,
            'top10FeaturesTag' => $top10FeaturesTag
        ));
    }

    public function save() {
        $user = $this->user->where('email', '=', Input::get('email'))->first();

        if (Input::get('delete-old-form') == 'Yes') {
            $applicationRegister = $this->applicationRegister->where('user_id', '=', $user->id)->where('status', '=', 2)->first();
            $resource = $this->resource->where('id', '=', $applicationRegister->form_id)->first();

            $applicationRegister->delete();
            $resource->delete();
        }

        date_default_timezone_set('America/Los_Angeles');

        // Application
        $formCode = Application::generateCode();

        $resource = new Application;

        $resource->form_code = $formCode;

        $resource->questions_and_answers = self::convertAnswersToJsonObj(Input::all());

        $resource->save();

        // User
        if (!$user) {
            $user = new User;

            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->role = 'applicant';

            $user->save();
        }
        else {
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');

            $user->save();
        }

        // Application Register
        $applicationRegister = new ApplicationRegister;

        $applicationRegister->user_id = $user->id;
        $applicationRegister->form_id = $resource->id;
        $applicationRegister->status = 2;
        $applicationRegister->left_at = Input::get('left-at');

        $applicationRegister->save();

        // Emailing
        $email_variables = array(
            'title' => 'Your Saved Application from Home Dream Builder',
            'link' => asset('/ready-to-dream') . '/' . $formCode,
            'email' => Input::get('email'),
//            'email' => 'snguyen@sccomputers.com',
            'name' => Input::get('firstname') . ' ' . Input::get('lastname')
        );

        Mail::send('emails/draft', $email_variables, function ($message) use ($email_variables) {
            $message->to($email_variables['email'], $email_variables['name'])
                ->subject($email_variables['title'])
            ;
        });

        return array('success' => true, 'form_code' => $formCode);
    }

    public function updateAndSave($formCode) {
        // Application
        $resource = $this->resource->where('form_code', '=', $formCode)->first();
        $resource->questions_and_answers = self::convertAnswersToJsonObj(Input::all());
        $resource->top_10_features = Input::get('top-10-features');
        $resource->top_10_features_tag = Input::get('top-10-features-tag');

        $resource->save();

        // Application Register
        $applicationRegister = $this->applicationRegister->where('form_id', '=', $resource->id)->first();
        $applicationRegister->left_at = Input::get('left-at');
        $applicationRegister->save();

        return array('form_code' => $formCode);
    }

    public function complete() {
        $formIsDrafted = $this->applicationRegister
            ->join('users', 'users.id', '=', 'application_register.user_id')
            ->where('users.email', '=', Input::get('email'))
            ->where('application_register.status', '=', 2)
            ->first();

        if ($formIsDrafted && Input::get('delete-old-form') == 'No') {
            $resource = $this->resource->where('id', '=', $formIsDrafted->form_id)->first();
        }
        else {
            if (Input::get('delete-old-form') == 'Yes') {
                $formIsDrafted->delete();
                $this->resource->where('id', '=', $formIsDrafted->form_id)->delete();
            }

            date_default_timezone_set('America/Los_Angeles');

            $formCode = Application::generateCode();

            $resource = new Application;
            $resource->form_code = $formCode;
        }

        $resource->phone = (!Input::has('no-schedule-call')) ? Input::get('first-num') . '-' . Input::get('second-num') . '-' . Input::get('third-num') : '';
        $resource->pre_approved_information = (Input::has('pre-approved-information')) ? 1 : 0;
        $resource->no_schedule_call = (Input::has('no-schedule-call')) ? 1 : 0;

        $resource->questions_and_answers = self::convertAnswersToJsonObj(Input::all());
        $resource->top_10_features = Input::get('top-10-features');
        $resource->top_10_features_tag = Input::get('top-10-features-tag');

        $resource->save();

        if (!$formIsDrafted) {
            // User
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->save();

            // Application Register
            $applicationRegister = new ApplicationRegister;
            $applicationRegister->user_id = $user->id;
            $applicationRegister->form_id = $resource->id;
            $applicationRegister->status = 1;
            $applicationRegister->save();
        }
        else if ($formIsDrafted && Input::get('delete-old-form') == 'Yes') {
            $user = $this->user->where('email', '=', Input::get('email'))->first();

            $this->applicationRegister->where('user_id', '=', $user->id)->where('status', '=', 2)->delete();

            // Application Register
            $applicationRegister = new ApplicationRegister;
            $applicationRegister->user_id = $user->id;
            $applicationRegister->form_id = $resource->id;
            $applicationRegister->status = 1;
            $applicationRegister->save();
        }
        else { //if ($formIsDrafted) {
            $applicationRegister = $this->applicationRegister->where('form_id', '=', $resource->id)->first();
            $applicationRegister->status = 1;
            $applicationRegister->left_at = '';
            $applicationRegister->save();
        }

        $form = array();
        foreach (json_decode($resource->questions_and_answers) as $questionTag => $answer) {
            $questionObj = DB::select(DB::raw('SELECT * FROM (SELECT id, type, tag, question, pros, cons, life_hacks FROM fixed_questions UNION SELECT id, type, tag, question, pros, cons, life_hacks FROM questions) AS all_question WHERE tag = "' . $questionTag . '"'))[0];
            $form['form'][$questionTag] = array(
                'question' => $questionObj->question,
                'answer' => $answer,
                'pros' => $questionObj->pros,
                'cons' => $questionObj->cons,
                'life_hacks' => $questionObj->life_hacks,
            );
        }

        $form['user']['firstname'] = Input::get('firstname');
        $form['user']['lastname'] = Input::get('lastname');
        $form['user']['email'] = Input::get('email');
        $form['user']['pre-approved-information'] = (Input::has('pre-approved-information')) ? 'Yes' : 'No';
        $form['user']['phone'] = (!Input::has('no-schedule-call')) ? Input::get('first-num') . '-' . Input::get('second-num') . '-' . Input::get('third-num') : '';

        $top10Features = array();
        foreach (explode(',', Input::get('top-10-features-tag')) as $featureTag) {
            $feature = DB::select('SELECT * FROM (SELECT tag, question FROM fixed_questions UNION SELECT tag, question FROM questions) AS all_questions WHERE tag = ?', [$featureTag]);

            if (count($feature) > 0) {
                $feature = $feature[0];
                array_push($top10Features, $feature->question);
            }

        }

        $form['top10features'] = implode('<>', $top10Features);
        $form['top10featuresTags'] = $resource->top_10_features_tag;

        Mail::send('emails/confirmation (v2)', $form, function ($message) use ($form) {
//            $message->to('snguyen@sccomputers.com', Input::get('firstname') . ' ' . Input::get('lastname'))
            $message->to('Albie.Anderman@TruVLending.com', 'Albie Anderman')
                ->subject('A New Application for Home Dream Builder from ' . Input::get('email'));
        });

        Mail::send('emails/congratulations (v2)', $form, function ($message) use ($form) {
//            $message->to('snguyen@sccomputers.com', Input::get('firstname') . ' ' . Input::get('lastname'))
            $message->to(Input::get('email'), Input::get('firstname') . ' ' . Input::get('lastname'))
                ->subject('Home Dream Builder congratulates you! ' . Input::get('firstname') . ' ' . Input::get('lastname'));
        });

        return array('success' => true, 'form_code' => $resource->form_code, 'form' => Input::all());
    }

    public function thankYou($formCode) {
        $resource = $this->resource->where('form_code', '=', $formCode)->first();
        $applicationRegister = $this->applicationRegister->where('form_id', '=', $resource->id)->first();

        $top10Features = array();
        $questions = array();
        foreach (explode(',', $resource->top_10_features_tag) as $featureTag) {
            $questionObj = DB::select(DB::raw('SELECT * FROM (
                                                SELECT id, type, tag, question, pros, cons, life_hacks FROM fixed_questions
                                                UNION
                                                SELECT id, type, tag, question, pros, cons, life_hacks FROM questions) AS all_question WHERE tag = "' . $featureTag . '"'
            ));

            if (count($questionObj) > 0) {
                $questionObj = $questionObj[0];
                array_push($questions, $questionObj);
                array_push($top10Features, $questionObj->question);
            }
        }

        if ($applicationRegister->status == 1) {
            return view('application/thank-you', array(
                'pageTitle' => 'Congratulations from Home Dream Builder - Application #' . $resource->id,
                'pageDescription' => '',
                'pageKeywords' => '',
                'application' => $resource,
                'applicationRegister' => $applicationRegister,
                'top10Features' => $top10Features,
                'questions' => $questions
            ));
        }
        else {
            return redirect('/');
        }
    }

    public function prosConsLifeHacks($tag) {
        $resources = DB::table('fixed_questions')->where('tag', '=', $tag)->first();
        if ($resources == null)
            $resources = DB::table('questions')->where('tag', '=', $tag)->first();

        return view('application/pros-cons-life-hacks', array(
            'pageTitle' => 'Pros / Cons / Life Hacks | ' . (($resources) ? $resources->question : 'N/A'),
            'pageDescription' => '',
            'pageKeywords' => '',
            'prosConsLifeHacks' => $resources,
        ));
    }


    public function reminder() {
        // 3 Days
        $this->sendReminder(3);

        // 7 Days
        $this->sendReminder(7);
    }

    public function delete() {
        date_default_timezone_set('America/Los_Angeles');

        $applicationRegisters10Days = $this->applicationRegister->where('status', '=', 2)->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime('-10 days')))->get();

        $users = $this->user->whereIn('id', $applicationRegisters10Days->lists('user_id'))->get();
        foreach ($users as $user) {
            $draftedForm = $this->applicationRegister->where('status', '=', 2)->where('user_id', '=', $user['id'])->first();
            $created_at = new DateTime($draftedForm['created_at']);

            $email_variables = array(
                'title' => 'Your Application from Home Dream Builder has been deleted',
                'email' => 'snguyen@sccomputers.com',
                'name' => $user['firstname'] . ' ' . $user['lastname'],
                'draftDate' => $created_at->format('m/d/Y'),
            );

            Mail::send('emails/delete', $email_variables, function ($message) use ($email_variables) {
                $message->to($email_variables['email'], $email_variables['name'])
                    ->subject($email_variables['title'])
                ;
            });
        }

        DB::table('applications')->whereIn('id', $applicationRegisters10Days->lists('form_id'))->delete();
        DB::table('application_register')->whereIn('form_id', $applicationRegisters10Days->lists('form_id'))->delete();
    }

    public function sendReminder($numOfDays) {
        date_default_timezone_set('America/Los_Angeles');

        $draftedForms = $this->applicationRegister
            ->join('users', 'users.id', '=', 'application_register.user_id')
            ->join('applications', 'applications.id', '=', 'application_register.form_id')
            ->where('application_register.status', '=', 2)
            ->where('application_register.created_at', '>=', date('Y-m-d 00:00:00', strtotime('-' . $numOfDays . ' days')))
            ->where('application_register.created_at', '<=', date('Y-m-d 23:59:59', strtotime('-' . $numOfDays . ' days')))
            ->select(
                'email',
                'firstname',
                'lastname',
                'form_code',
                'application_register.created_at'
            )
            ->get()
        ;

        foreach ($draftedForms as $form) {
            $created_at = new DateTime($form['created_at']);
            $last_day = clone $created_at;
            $last_day->modify('+10 days');

            $email_variables = array(
                'title' => 'Complete Your Application from Home Dream Builder',
                'link' => asset('/ready-to-dream') . '/' . $form['form_code'],
                'email' => 'snguyen@sccomputers.com',
                'name' => $form['firstname'] . ' ' . $form['lastname'],
                'draftDate' => $created_at->format('m/d/Y'),
                'lastDate' => $last_day->format('m/d/Y')
            );

            Mail::send('emails/reminder', $email_variables, function ($message) use ($email_variables) {
                $message->to($email_variables['email'], $email_variables['name'])
                    ->subject($email_variables['title'])
                ;
            });
        }
    }

    public function checkForExistingDrafts() {
        $draft = $this->applicationRegister
            ->join('users', 'users.id', '=', 'application_register.user_id')
            ->where('users.email', '=', Input::get('email'))
            ->where('application_register.status', '=', 2)
            ->where('application_register.form_id', '!=', ((Input::has('form-id')) ? Input::get('form-id') : 0))
            ->first();

        return array('found' => ($draft) ? true : false);
    }


    public function testComplete() {
        $resource = $this->resource->where('id', '=', 59)->first();

        $resource->phone = '123-456-7890';
        $resource->pre_approved_information = 0;
        $resource->no_schedule_call = 1;

        $form = array();
        foreach (json_decode($resource->questions_and_answers) as $questionTag => $answer) {
            $questionObj = DB::select(DB::raw('SELECT * FROM (SELECT id, type, tag, question, pros, cons, life_hacks FROM fixed_questions UNION SELECT id, type, tag, question, pros, cons, life_hacks FROM questions) AS all_question WHERE tag = "' . $questionTag . '"'))[0];
            $form['form'][$questionTag] = array(
                'question' => $questionObj->question,
                'answer' => $answer,
                'pros' => $questionObj->pros,
                'cons' => $questionObj->cons,
                'life_hacks' => $questionObj->life_hacks,
            );
        }

        $form['user']['firstname'] = 'John';
        $form['user']['lastname'] = 'Doe';
        $form['user']['email'] = 'testform@email.com';
        $form['user']['pre-approved-information'] = 'Yes';
        $form['user']['phone'] = '123-456-7890';

        $form['top10features'] = $resource->top_10_features;
        $form['top10featuresTags'] = $resource->top_10_features_tag;

        Mail::send('emails/congratulations (v2)', $form, function ($message) use ($form) {
            $message->from('Albie.Anderman@TruVLending.com', 'Home Dream Builder');
            $message->to('snguyen@sccomputers.com', 'Steven Nguyen')
                ->subject('Home Dream Builder congratulates you!');
        });

        //dd(count(Mail::failures()));
    }

    public function testEmail() {
        // Emailing
        $email_variables = array(
            'title' => 'Your Saved Application from Home Dream Builder',
            'link' => asset('/ready-to-dream'),
            'email' => 'snguyen@sccomputers.com',
            'name' => 'John Doe'
        );

        Mail::send('emails/draft', $email_variables, function ($message) use ($email_variables) {
            $message->to($email_variables['email'], $email_variables['name'])
                ->subject($email_variables['title'])
            ;
        });
    }
}
