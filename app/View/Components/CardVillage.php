<?php

namespace App\View\Components;

use App\Models\Province;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardVillage extends Component
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
        $villages = Village::query()->with('district');

        if ($user->role == 'provinsi') {
            $villages = Province::where('id', $user->province_id)->first()->villages->toQuery();
        }

        if ($user->role == 'kota') {
            $villages->whereHas('district', function ($query) use ($user) {
                return $query->where('regency_id', $user->regency_id);
            });
        }

        if ($user->role == 'kecamatan') {
            $villages->where('district_id', $user->district_id);
        }

        return view('components.card-village', [
            'totalVillage' => $villages->count()
        ]);
    }
}
