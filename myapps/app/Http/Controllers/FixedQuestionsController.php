<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\FixedQuestion;

use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FixedQuestionsController extends BaseController {

    protected $resource;
    protected $application;

    public function __construct(FixedQuestion $resource, Application $application) {
        $this->resource = $resource;
        $this->application = $application;
    }

    public function index_admin() {
        $resources = $this->resource
            ->orderBy('id')
            ->get();

        return view('admin/fixed-questions/questions', array(
            'pageTitle' => 'Admin Fixed Questions',
            'pageDescription' => '',
            'pageKeywords' => '',
            'questions' => $resources
        ));
    }

    public function create() {
        return view('admin/fixed-questions/create', array(
            'pageTitle' => 'Add Fixed Question',
            'pageDescription' => ''
        ));
    }

    public function store() {

        if (!$this->resource->isValid($input = Input::all())) {
            return back()->withInput()->withErrors($this->resource->errors);
        }

        $resource = new FixedQuestion;

        $resource->type = Input::get('question-type');
        $resource->title = Input::get('title');
        $resource->question = Input::get('question');
        $resource->tag = Question::convertToTag((Input::get('tag') != '') ? Input::get('tag') : Input::get('question'));
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

        return redirect('admin/fixed-questions');
    }

    public function edit($id) {
        $resource = $this->resource->where('id', '=', $id)->first();

        return view('admin/fixed-questions/edit',
            array(
                'pageTitle' => 'Edit Question #' . $id,
                'pageDescription' => 'Edit Question #' . $id .  ' for Cease My Lease.',
                'id' => $id,
                'question' => $resource
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

        $resource->type = Input::get('question-type');
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

        return redirect('admin/fixed-questions');
    }

    public function destroy($id) {
        $resource = $this->resource->where('id', '=', $id)->first();
        $resource->delete();

        return redirect('admin/fixed-questions');
    }

    public function toggleActive() {
        $resource = $this->resource->where('id', '=', Input::get('id'))->first();
        $resource->active = ($resource->active == 1) ? 0 : 1;

        $resource->save();

        $resource = $this->resource->where('id', '=', Input::get('id'))->first();

        return response()->json(
            array(
                'status' => 'success',
                'id' => Input::get('id'),
                'active' => $resource->active,
                'active-opposite-text' => ($resource->active == 1) ? 'Disable' : 'Enable'
            )
        );
    }
}
