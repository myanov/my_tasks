<?php

namespace App\Modules\Admin\Dashboard\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Base extends Controller
{
    protected string $template;
    protected \Illuminate\Contracts\Auth\Authenticatable|null $user;
    protected string $title;
    protected string $content;
    protected string $sidebar;
    protected array $vars = [];
    protected string $locale;

    public function __construct()
    {
        $this->template = "Admin::Dashboard.dashboard";

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->locale = App::getLocale();

            return $next($request);
        });
    }

    protected function renderOutput()
    {
        $this->vars = Arr::add($this->vars, 'content', $this->content);
        $this->vars = Arr::add($this->vars, 'sidebar', '');

        $this->sidebar = view('Admin::layouts.parts.sidebar')->with([
            'menu' => '',
            'user' => $this->user
        ])->render();
        $this->vars = Arr::add($this->vars, 'sidebar', $this->sidebar);

        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {

    }
}
