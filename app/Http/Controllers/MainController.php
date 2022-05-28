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

        abort_if(!view()->exists("pages.$view"), 404);

        return view("pages.$view");
    }
}
