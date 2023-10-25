<?php

namespace App\Http\Controllers;

use App\Models\User;

use Exception;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SessionsController extends BaseController
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    // Called when the user goes to /login as defined in routes.php
    public function create()
    {
        // If the user is already logged in then redirect to the admin panel
        if (Auth::check())
            return redirect('admin/home');
        // Else show the login page view
        return view('admin/sessions/create');
    }

    // Called when the login form is submitted
    public function store()
    {
        // If the user enters the correct login credentials
        if (Auth::attempt(Input::only('email', 'password'))) {
            // Go to the admin panel
            return redirect('admin/home');
            // If the user enters the wrong login credentials
        } else {
            // Return an error message
            return back()->withErrors(array('login' => 'Login incorrect, please try again.'));
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('admin/login');
    }

    public function create_user() {
        $user = new User;

        $user->email = 'aanderman@peoplesmortgage.com';
        $user->password = Hash::make('AhTYzY78kmR2eTXH');
        $user->firstname = 'Albie';
        $user->lastname = 'Anderman';
        $user->role = 'admin';

        $user->save();

        return redirect('admin/login');
    }

    public function update_password() {
        $user = $this->user->where('id', '=', 1)->first();

        $user->password = Hash::make('password');

        $user->save();

        return redirect('admin/login');
    }
}
