<?php

use App\Http\Controllers\PackageInfoController;
use Illuminate\Support\Facades\Route;

Route::get('packages', PackageInfoController::class)->name('packages');
