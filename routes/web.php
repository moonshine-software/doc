<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('async', function (){
   return fake()->text();
})->name('async');
