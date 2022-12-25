<?php

namespace App\Modules\Pub\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = "admin/dashboard";

    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function showLoginForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $title = __("public.login_title");

        return view("Pub::Auth.login", ["title" => $title]);
    }
}
