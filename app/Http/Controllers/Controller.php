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
        $user2 = User::find(2);
        $user1 = User::find(1);

        return view('home', [
            'user1' => [
                'user' => $user1,
                'weights' => $this->data->getWeights($user1),
                'today' => $this->data->getToday($user1),
                'change' => $this->data->getChange($user1),
            ],
            'user2' => [
                'user' => $user2,
                'weights' => $this->data->getWeights($user2),
                'today' => $this->data->getToday($user2),
                'change' => $this->data->getChange($user2),
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
