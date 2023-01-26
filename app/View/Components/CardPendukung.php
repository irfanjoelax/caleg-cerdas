<?php

namespace App\View\Components;

use App\Models\Pendukung;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardPendukung extends Component
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

        $pendukungs = Pendukung::query();

        if ($user->role == 'provinsi') {
            $pendukungs->where('province_id', $user->province_id);
        }

        if ($user->role == 'kota') {
            $pendukungs->where('regency_id', $user->regency_id);
        }

        if ($user->role == 'kecamatan') {
            $pendukungs->where('district_id', $user->district_id);
        }

        if ($user->role == 'kelurahan') {
            $pendukungs->where('village_id', $user->village_id);
        }

        $totalPendukung = $pendukungs->count();

        return view('components.card-pendukung', compact('totalPendukung'));
    }
}
