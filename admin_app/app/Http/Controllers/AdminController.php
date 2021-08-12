<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function getChangePassword()
    {
        /**
         * @var CanResetPassword $user
         */
        $user = Auth::user();
        $email = $user->getEmailForPasswordReset();
    
        /**
         * @var PasswordBroker $broker
         */
        $broker = app('auth.password.broker');
        $broker->deleteToken($user);
        $token = $broker->createToken($user);

        return redirect(route("password.reset", ['token' => $token, 'email' => $email]));
    }
}
