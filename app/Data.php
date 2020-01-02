<?php

namespace App;

use Carbon\Carbon;

class Data
{
    public function getData() {
        $users = User::all();
        $result = collect();

        $colours = collect([
            'rgb(54, 162, 235)', 'rgb(75, 192, 192)'
        ]);

        foreach($users as $index => $user) {
            $result->push([
                'label' => $user->name,
                'data' => $user->weights->pluck('weight'),
                'fill' => false,
                'borderColor' => $colours[$index]
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
                    return '<span class="text-red-700">(+)</span>';
                }

                if ($today->weight == $previous->weight) {
                    return 'nc';
                }

                if ($today->weight < $previous->weight) {
                    return '<span class="text-green-700">(-)</span>';
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