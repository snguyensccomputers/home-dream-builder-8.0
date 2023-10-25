<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Question extends Model {

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
    protected $table = 'questions';

    public function isValid($data) {
        $validation = Validator::make($data, static::$rules, static::$messages);

        if ($validation->passes())
            return true;

        $this->errors = $validation->messages();

        return false;
    }

    public static function convertToTag($tag) {
        $tag = strtolower($tag);
        $tag = preg_replace('/[^A-Za-z0-9\- ]/', '', $tag);
        $tag = preg_replace('!\s+!', ' ', $tag);
        $tag = str_replace(' ', '-', $tag);

        return $tag;
    }

    public static function filteredPost($post) {
        $post = preg_replace('/\s+/', ' ', trim($post));
        $post = preg_replace('/<div [\s\S]+?>/', '<div>', $post);
        $post = preg_replace('/<div>/', '<p>', $post);
        $post = preg_replace('/<\/div>/', '</p>', $post);
        $post = preg_replace('/<ul [\s\S]+?>/', '<ul>', $post);
        $post = preg_replace('/<li [\s\S]+?>/', '<li>', $post);
        $post = preg_replace('/<span [\s\S]+?>/', '<span>', $post);
        if (strpos($post, '<ul>') === false) {
            $post = preg_replace('/<span>/', '<p>', $post);
            $post = preg_replace('/<\/span>/', '</p>', $post);
        }
        $post = preg_replace('/<p [\s\S]+?>/', '<p>', $post);
        $post = preg_replace('/<br>/', '', $post);

        return $post;
    }

}
