<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::match(['get', 'post'], 'async', function (){
   return fake()->text();
})->name('async');
