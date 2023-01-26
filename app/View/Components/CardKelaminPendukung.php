<?php

namespace App\View\Components;

use App\Models\Pendukung;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardKelaminPendukung extends Component
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

        if ($user->role == 'provinsi') {
            $totalPendukung = Pendukung::where('province_id', '=', env('PROVINSI_ID'))->count();
        }

        if ($user->role == 'kota') {
            $totalPendukung = Pendukung::where('regency_id', $user->regency_id)->count();
        }

        if ($user->role == 'kecamatan') {
            $totalPendukung = Pendukung::where('district_id', $user->district_id)->count();
        }

        if ($user->role == 'kelurahan') {
            $totalPendukung = Pendukung::where('village_id', $user->village_id)->count();
        }

        if ($user->role == 'relawan') {
            $totalPendukung = Pendukung::where('relawan_id', $user->relawan->id)->count();
        }

        $totalPria = persen(sum_pendukung('PRIA'), $totalPendukung);
        $totalWanita = persen(sum_pendukung('WANITA'), $totalPendukung);

        return view('components.card-kelamin-pendukung', compact('totalPria', 'totalWanita'));
    }
}
