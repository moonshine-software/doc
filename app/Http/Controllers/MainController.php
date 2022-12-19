<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return $this->renderIfExists("home");
    }

    public function section(string $section)
    {
        return $this->renderIfExists(
            str_replace('-', '.', $section)
        );
    }

    private function renderIfExists(string $view)
    {
        $path = "pages.".app()->getLocale().".$view";

        abort_if(!view()->exists($path), 404);

        return view($path);
    }
}
