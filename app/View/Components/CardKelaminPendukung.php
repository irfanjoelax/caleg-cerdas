<?php

namespace App\View\Components;

use App\Models\Pendukung;
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
        $totalPendukung = Pendukung::where('province_id', env('PROVINSI_ID'))->count();

        $totalPria = persen(sum_pendukung('PRIA'), $totalPendukung);
        $totalWanita = persen(sum_pendukung('WANITA'), $totalPendukung);

        return view('components.card-kelamin-pendukung', compact('totalPria', 'totalWanita'));
    }
}
