<?php

use Illuminate\Support\Facades\Route;

//Route::view('/', 'home')->name('home');
Route::redirect('/', '/docs');

Route::get('async', function (){
   return fake()->text();
})->name('async');
