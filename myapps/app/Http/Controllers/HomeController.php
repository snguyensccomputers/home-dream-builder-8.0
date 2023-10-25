<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController {

    public function home() {
        return view('home/home', array(
            'pageTitle' => 'Home',
            'pageDescription' => '',
            'pageKeywords' => ''
        ));
    }

}
