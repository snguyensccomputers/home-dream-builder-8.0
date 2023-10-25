<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PageController extends BaseController
{
    public function admin_home() {
        return view('admin/home/home');
    }
}
