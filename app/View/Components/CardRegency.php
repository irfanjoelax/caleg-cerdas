<?php

namespace App\View\Components;

use App\Models\Regency;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardRegency extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('components.card-regency', [
            'totalRegencies' => Regency::where('province_id', Auth::user()->province_id)->count()
        ]);
    }
}
