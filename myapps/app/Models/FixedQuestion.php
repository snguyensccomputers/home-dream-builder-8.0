<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FixedQuestion extends Model {

    public $timestamps = false;

    protected $fillable = array(
        'question',
    );

    public static $rules = array(
        'question' => 'required',
    );

    public static $messages = array(
        'question.required' => 'Question is required',
    );

    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'fixed_questions';

    public function isValid($data) {
        $validation = Validator::make($data, static::$rules, static::$messages);

        if ($validation->passes())
            return true;

        $this->errors = $validation->messages();

        return false;
    }

}
