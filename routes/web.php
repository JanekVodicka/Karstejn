<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DbViewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InfoController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('galerie_akce', function () {
    return view('galerie_akce');
})->name('galerie_akce');

Route::get('galerie_ostatni', function () {
    return view('galerie_ostatni');
})->name('galerie_ostatni');

Route::get('galerie_rocniky', [GalleryController::class, 'showToGalerieRocniky'])
->name('galerie_rocniky');

Route::get('galerie_videa', function() {
    return view('galerie_videa');
})->name('galerie_videa');

Route::get('info',[InfoController::class, 'showToInfo'])
->name('info');


Route::get('kronika', function() {
    return view('kronika');
})->name('kronika');

Route::get('prihlaska', function() {
    return view('prihlaska');
})->name('prihlaska');

Route::get('login', function(){
    return view('login');
})->name('login');

Route::post('login', [LoginController::class, 'login'])->name('login.form');

Route::get('galerie/{event}/{year}', [GalleryController::class, 'showToGalerie'])
    ->name('galerie');

Route::post('form', [FormController::class, 'handleFormSubmission'])
->name('prihlaska.store');
 
// Route accessible only by admin
Route::get('prihlasky-private', [DbViewController::class, 'showPrihlaskyDb'])
    ->middleware('admin')  // Use 'admin' middleware here
    ->name('prihlasky-private');
 
// Route accessible by all auth
Route::get('/settings', function () {
    return view('settings');
})->name('settings')->middleware('auth'); // Use 'auth' middleware for all users

Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');