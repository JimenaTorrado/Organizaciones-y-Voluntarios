<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Solo usuarios con sesión iniciada: los controladores guardan $request->user()->id en registered_by.
Route::middleware('auth')->group(function () {
    Route::resource('organizations', OrganizationController::class);
    Route::resource('volunteers', VolunteerController::class);

    Route::post('organizations/{organization}/vincular', [OrganizationController::class, 'vincular'])
        ->name('organizations.vincular');
});
