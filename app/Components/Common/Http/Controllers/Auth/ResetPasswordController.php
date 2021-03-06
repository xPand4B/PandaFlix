<?php

namespace App\Components\Common\Http\Controllers\Auth;

use App\Components\Common\Http\Controllers\Controller;
use App\Components\Common\PandaFlix;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = PandaFlix::REDIRECT_TO_URL_AFTER_LOGIN;
}
