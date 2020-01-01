<?php

namespace App\Http\Controllers;

use App\Data;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function index()
    {
        $phil = User::find(2);
        $dave = User::find(1);

        return view('home', [
            'dave' => [
                'weights' => $this->data->getWeights($dave),
                'today' => $this->data->getToday($dave),
                'change' => $this->data->getChange($dave),
            ],
            'phil' => [
                'weights' => $this->data->getWeights($phil),
                'today' => $this->data->getToday($phil),
                'change' => $this->data->getChange($phil),
            ],
            'data' => json_encode($this->data->getData()),
            'labels' => json_encode($this->data->getLabels())
        ]);
    }

    public function save(User $user, Request $request)
    {
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
    }
}
