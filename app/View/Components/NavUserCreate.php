<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavUserCreate extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        if (Auth::user()->role == 'provinsi') {
            $title = 'Kota/Kabupaten';
        }

        if (Auth::user()->role == 'kota') {
            $title = 'Kecamatan';
        }

        if (Auth::user()->role == 'kecamatan') {
            $title = 'Kelurahan';
        }

        return view('components.nav-user-create', [
            'title' => $title,
        ]);
    }
}
