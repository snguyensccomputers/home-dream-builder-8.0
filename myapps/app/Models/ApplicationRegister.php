<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ApplicationRegister extends Model {

    protected $fillable = array(

    );

    public static $rules = array(

    );

    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'application_register';

    public function isValid($data) {
        $validation = Validator::make($data, static::$rules);

        if ($validation->passes())
            return true;

        $this->errors = $validation->messages();

        return false;
    }

}
