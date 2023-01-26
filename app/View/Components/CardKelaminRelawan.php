<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardKelaminRelawan extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user = Auth::user();

        if ($user->role == 'kelurahan') {
            $totalRelawan = User::where([
                ['role', '=', 'relawan'],
                ['village_id', '=', $user->village_id],
            ])->count();
        }

        if ($user->role == 'kecamatan') {
            $totalRelawan = User::where([
                ['role', '=', 'relawan'],
                ['district_id', '=', $user->district_id],
            ])->count();
        }

        if ($user->role == 'kota') {
            $totalRelawan = User::where([
                ['role', '=', 'relawan'],
                ['regency_id', '=', $user->regency_id],
            ])->count();
        }

        if ($user->role == 'provinsi') {
            $totalRelawan = User::where([
                ['role', '=', 'relawan'],
                ['province_id', '=', env('PROVINSI_ID')],
            ])->count();
        }

        $totalPria = persen(sum_relawan('PRIA'), $totalRelawan);
        $totalWanita = persen(sum_relawan('WANITA'), $totalRelawan);

        return view('components.card-kelamin-relawan', compact('totalPria', 'totalWanita'));
    }
}
