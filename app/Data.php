<?php

namespace App;

use Carbon\Carbon;

class Data
{
    public function getData() {
        $users = User::all();

        $result = collect();

        foreach($users as $user) {
            $result->push([
                'label' => $user->name,
                'data' => $user->weights->pluck('weight')
            ]);
        }
        return $result;
    }

    public function getLabels() {
        $weights = Weight::orderBy('created_at')->get();

        $weights = $weights->groupBy(function ($item) {
            return Carbon::parse($item['created_at'])->format('M d');
        })->map(function($item){
            return $item->all();
        });

        $dates = $weights->keys();

        return $dates;
    }

    public function getChange($user) {
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

    public function getToday($user) {
        return $user->weights()->whereDate('created_at', Carbon::today())->first();
    }

    public function getWeights($user) {
        return $user->weights()->orderBy('created_at')->get();
    }
}