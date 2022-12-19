<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function section(string $section)
    {
        $view = str_replace('-', '.', $section);
        $path = "pages.".app()->getLocale().".$view";

        abort_if(!view()->exists($path), 404);

        return view($path);
    }
}
