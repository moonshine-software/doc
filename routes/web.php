<?php

use Illuminate\Support\Facades\Route;
use MoonShine\Http\Middleware\ChangeLocale;

Route::get('/', function () {
    return view("home-" . app()->getLocale());
})
    ->middleware(ChangeLocale::class)
    ->name('home');

Route::get('{local}', function ($local) {
    session()->put('change-moonshine-locale', $local);
    return redirect()->intended(route('home'));
})
    ->where('local', 'en|ru')
    ->name('locale');

Route::match(['get', 'post'], 'async', function (){
   return fake()->text();
})
    ->name('async');
