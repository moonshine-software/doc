<?php

use Illuminate\Support\Facades\Route;
use MoonShine\Http\Middleware\ChangeLocale;

Route::get('/', function () {
    return view("home-" . app()->getLocale());
})
    ->middleware(ChangeLocale::class)
    ->name('home');

Route::match(['get', 'post'], 'async', function (){
   return fake()->text();
})->name('async');
