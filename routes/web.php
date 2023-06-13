<?php

use App\Http\Controllers\PackageInfoController;
use Illuminate\Support\Facades\Route;

Route::get('packages/{package}', PackageInfoController::class)->name('packages');
