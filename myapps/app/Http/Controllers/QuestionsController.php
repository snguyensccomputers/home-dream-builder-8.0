<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Question;

use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class QuestionsController extends BaseController {

    protected $resource;
    protected $application;

    public function __construct(Question $resource, Application $application) {
        $this->resource = $resource;
        $this->application = $application;
    }

    public function index_admin() {
        $resources = $this->resource
            ->leftJoin('features', 'features.id', '=', 'questions.feature_id')
            ->select(
                'questions.id',
                'type',
                'feature',
                'question'
            )
            ->orderBy('questions.id')
            ->get();

        return view('admin/questions/questions', array(
            'pageTitle' => 'Admin Questions',
            'pageDescription' => '',
            'pageKeywords' => '',
            'questions' => $resources
        ));
    }

    public function create() {
        $features = DB::table('features')->lists('feature', 'id');

        return view('admin/questions/create', array(
            'pageTitle' => 'Add Question',
            'pageDescription' => '',
            'features' => $features
        ));
    }

    public function store() {

        if (!$this->resource->isValid($input = Input::all())) {
            return back()->withInput()->withErrors($this->resource->errors);
        }

        $resource = new Question;

        $resource->feature_id = Input::get('feature');
        $resource->type = Input::get('question-type');
        $resource->tag = Question::convertToTag((Input::get('tag') != '') ? Input::get('tag') : Input::get('question'));
        $resource->question = Input::get('question');
        // Pros, Cons, Life Hacks
        $resource->pros = Question::filteredPost(Input::get('pros'));
        $resource->cons = Question::filteredPost(Input::get('cons'));
        $resource->life_hacks = Question::filteredPost(Input::get('life_hacks'));

        if (Input::file('image')) {
            $image = Input::file('image');
            $destinationPath = dirname(__FILE__) . '/../../../public_html/images/homedreambuilder/application/other-features';
            $filename_image = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();   // .jpg, .png
            $uploadSuccess = Input::file('image')->move($destinationPath, $filename_image);

            if ($uploadSuccess)
                $resource->image = $filename_image;
            else
                die('The image upload failed!');
        }

        $resource->save();

        return redirect('admin/questions');
    }

    public function edit($id) {
        $resource = $this->resource->where('id', '=', $id)->first();
        $features = DB::table('features')->lists('feature', 'id');
        $questions = DB::table('questions')->where('id', '>', $id)->get();

        return view('admin/questions/edit',
            array(
                'pageTitle' => 'Edit Question #' . $id,
                'pageDescription' => 'Edit Question #' . $id .  ' for Home Dream Builder.',
                'id' => $id,
                'question' => $resource,
                'features' => $features,
                'otherQuestions' => $questions
            )
        );
    }

    public function update($id) {

        if (!$this->resource->isValid($input = Input::all())) {
            return back()->withInput()->withErrors($this->resource->errors);
        }

        $resource = $this->resource->where('id', '=', $id)->first();

        if ($resource->question != Input::get('question')) {
            $applications = $this->application->where('top_10_features', 'LIKE', '%' . $resource->question . '%')->get();

            foreach ($applications as $application) {
                $resourceApplication = $this->application->where('id', '=', $application->id)->first();

                $top_10_features = array();
                foreach (explode(',',$application->top_10_features) as $feature) {
                    $include_feature = ($feature == $resource->question) ? Input::get('question') : $feature;
                    array_push($top_10_features, $include_feature);
                }
                $resourceApplication->top_10_features = implode(',',$top_10_features);
                $resourceApplication->save();
            }
        }

        $resource->feature_id = Input::get('feature');
        $resource->type = Input::get('question-type');
        $resource->tag = Question::convertToTag((Input::get('tag') != '') ? Input::get('tag') : Input::get('question'));
        $resource->question = Input::get('question');
        // Pros, Cons, Life Hacks
        $resource->pros = Question::filteredPost(Input::get('pros'));
        $resource->cons = Question::filteredPost(Input::get('cons'));
        $resource->life_hacks = Question::filteredPost(Input::get('life_hacks'));
        // Causes question skips
        $resource->trigger_skip = Input::get('trigger_skip');   // If '1' => If answer is 'No', skip several following questions
        $resource->questions_to_skip_ids = Input::get('questions_to_skip_ids'); // If trigger_skip is '1', skip to this question by id

        if (Input::file('image')) {
            $image = Input::file('image');
            $destinationPath = dirname(__FILE__) . '/../../../public_html/images/homedreambuilder/application/other-features';
            $filename_image = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();   // .jpg, .png
            $uploadSuccess = Input::file('image')->move($destinationPath, $filename_image);

            if ($uploadSuccess)
                $resource->image = $filename_image;
            else
                die('The image upload failed!');
        }

        $resource->save();

        return redirect('admin/questions');
    }

    public function destroy($id) {
        $resource = $this->resource->where('id', '=', $id)->first();
        $resource->delete();

        return redirect('admin/questions');
    }
}
