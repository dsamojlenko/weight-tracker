<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {

    $phil = User::find(2);
    $dave = User::find(1);

    return view('home', [
        'phil_weights' => $phil->weights,
        'dave_weights' => $dave->weights,
    ]);
});

Route::post('/user/{user}/weight', function(\App\User $user) {
    $user->weights()->create([
        'weight' => request('weight'),
    ]);

    return back();
});