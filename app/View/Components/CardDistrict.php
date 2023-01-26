<?php

namespace App\View\Components;

use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardDistrict extends Component
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
        $districts = District::query();

        if ($user->role == 'provinsi') {
            $districts->whereHas('regency', function ($query) {
                return $query->where('province_id', Auth::user()->province_id);
            });
        }

        if ($user->role == 'kota') {
            $districts->where('regency_id', $user->regency_id);
        }

        return view('components.card-district', [
            'totalDistrict' => $districts->count()
        ]);
    }
}
