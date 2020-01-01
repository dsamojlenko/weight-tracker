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
use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;

function getData() {
    // Dave Data
    $dave = \App\Weight::where('user_id', 1)->get();

    // Phil Data
    $phil = \App\Weight::where('user_id', 2)->get();

    return [
        [
            'label' => 'Dave',
            'data' => $dave->pluck('weight')
        ],
        [
            'label' => 'Phil',
            'data' => $phil->pluck('weight')
        ],
    ];
}

function getLabels() {
    $weights = Weight::orderBy('created_at')->get();

    $weights = $weights->groupBy(function ($item) {
        return Carbon::parse($item['created_at'])->format('M d');
    })->map(function($item){
        return $item->all();
    });

    $dates = $weights->keys();

    return $dates;
}

function getChange($user) {
    $change = null;

    if($today = $user->weights()->whereDate('created_at', Carbon::today())->first()) {
        $previous = $user->weights()->where('id', '!=', $today->id)->latest('created_at')->first();

        if($previous) {
            if ($today->weight > $previous->weight) {
                return '+';
            }

            if ($today->weight == $previous->weight) {
                return 'nc';
            }

            if ($today->weight < $previous->weight) {
                return '-';
            }
        }

        return false;
    }
}

function getToday($user) {
    return $user->weights()->whereDate('created_at', Carbon::today())->first();
}

function getWeights($user) {
    return $user->weights()->orderBy('created_at')->get();
}

Route::get('/', function () {

    $phil = User::find(2);
    $dave = User::find(1);

    return view('home', [
        'dave' => [
            'weights' => getWeights($dave),
            'today' => getToday($dave),
            'change' => getChange($dave),
        ],
        'phil' => [
            'weights' => getWeights($phil),
            'today' => getToday($phil),
            'change' => getChange($phil),
        ],
        'data' => json_encode(getData()),
        'labels' => json_encode(getLabels())
    ]);
});

Route::post('/user/{user}/weight', function(\App\User $user, Request $request) {
    $request->validate([
        'weight' => 'required|numeric'
    ]);

    $today = \App\Weight::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->get();

    if ($today->count()) {
        return back()->with('error', 'You already recorded your weight today ' . Carbon::today()->format('M d') . '. Come back tomorrow.');
    }

    $user->weights()->create([
        'weight' => request('weight'),
    ]);

    return back();
});