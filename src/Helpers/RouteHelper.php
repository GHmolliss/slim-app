<?php

declare(strict_types=1);

namespace App\Helpers;

final class RouteHelper
{
    public const SHOW_HOME = 'home';

    public const AUTH_SHOW_LOGIN = 'login';
    public const AUTH_SHOW_LOGOUT = 'logout';
    public const AUTH_SHOW_REGISTER = 'register';
    public const AUTH_SHOW_VERIFY_EMAIL = 'verifyEmail';
    public const AUTH_SHOW_PASSWORD_FORGOT = 'passwordForgot';
    public const AUTH_SHOW_PASSWORD_RESET = 'passwordReset';

    public const AUTH_SHOW_PROFILE = 'showProfile';

    public const API_AUTH_LOGIN = 'apiLogin';
    public const API_AUTH_REGISTER = 'apiRegister';
    public const API_PASSWORD_FORGOT = 'apiPasswordForgot';
    public const API_PASSWORD_RESET = 'apiPasswordReset';
}
