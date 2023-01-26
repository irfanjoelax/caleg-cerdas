<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardRelawan extends Component
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

        $users = User::query()->with('relawan')->where('role', 'relawan');

        if ($user->role == 'provinsi') {
            $users->where('province_id', $user->province_id);
        }

        if ($user->role == 'kota') {
            $users->where('regency_id', $user->regency_id);
        }

        if ($user->role == 'kecamatan') {
            $users->where('district_id', $user->district_id);
        }

        if ($user->role == 'kelurahan') {
            $users->where('village_id', $user->village_id);
        }

        $totalRelawan = $users->count();

        return view('components.card-relawan', compact('totalRelawan'));
    }
}
