<?php

namespace App\View\Components;

use App\Models\VotingPlace;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardVoter extends Component
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
        $places = VotingPlace::query();

        $user = Auth::user();

        if ($user->role == 'provinsi') {
            $places->where('province_id', $user->province_id);
        }

        if ($user->role == 'kota') {
            $places->where('regency_id', $user->regency_id);
        }

        if ($user->role == 'kecamatan') {
            $places->where('district_id', $user->district_id);
        }

        if ($user->role == 'kelurahan') {
            $places->where('village_id', $user->village_id);
        }

        $totalDPT = $places->get()->sum('total_dpt');

        return view('components.card-voter', compact('totalDPT'));
    }
}
