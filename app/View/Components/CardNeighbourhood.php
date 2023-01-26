<?php

namespace App\View\Components;

use App\Models\Neighbourhood;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardNeighbourhood extends Component
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
        $neighbourhoods = Neighbourhood::query();

        $user = Auth::user();

        if ($user->role == 'provinsi') {
            $neighbourhoods->where('province_id', $user->province_id);
        }

        if ($user->role == 'kota') {
            $neighbourhoods->where('regency_id', $user->regency_id);
        }

        if ($user->role == 'kecamatan') {
            $neighbourhoods->where('district_id', $user->district_id);
        }

        if ($user->role == 'kelurahan') {
            $neighbourhoods->where('village_id', $user->village_id);
        }

        $totalNeighbourhood = $neighbourhoods->count();

        return view('components.card-neighbourhood', compact('totalNeighbourhood'));
    }
}
