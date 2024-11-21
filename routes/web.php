<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('galerie_akce', function () {
    return view('galerie_akce');
})->name('galerie_akce');

Route::get('galerie_ostatni', function () {
    return view('galerie_ostatni');
})->name('galerie_ostatni');

Route::get('galerie_rocniky', function() {
    return view('galerie_rocniky');
})->name('galerie_rocniky');

Route::get('galerie_videa', function() {
    return view('galerie_videa');
})->name('galerie_videa');

Route::get('info', function() {
    return view('info');
})->name('info');

Route::get('kronika', function() {
    return view('kronika');
})->name('kronika');

Route::get('prihlaska', function() {
    return view('prihlaska');
})->name('prihlaska');

Route::get('settings', function() {
    return view('settings');
})->name('settings');

Route::get('galerie/{event}/{year}', [GalleryController::class, 'show'])
    ->name('galerie');

Route::post('form', [FormController::class, 'store'])
->name('prihlaska.store');
