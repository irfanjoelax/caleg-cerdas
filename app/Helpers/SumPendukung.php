<?php

use App\Models\Pendukung;
use Illuminate\Support\Facades\Auth;

function sum_pendukung($kelamin)
{
    $user = Auth::user();

    if ($user->role == 'kelurahan') {
        $total_pendukung = Pendukung::where([
            ['kelamin', '=', $kelamin],
            ['village_id', '=', $user->village_id],
        ])->count();
    }

    if ($user->role == 'kecamatan') {
        $total_pendukung = Pendukung::where([
            ['kelamin', '=', $kelamin],
            ['district_id', '=', $user->district_id],
        ])->count();
    }

    if ($user->role == 'kota') {
        $total_pendukung = Pendukung::where([
            ['kelamin', '=', $kelamin],
            ['regency_id', '=', $user->regency_id],
        ])->count();
    }

    if ($user->role == 'provinsi') {
        $total_pendukung = Pendukung::where([
            ['kelamin', '=', $kelamin],
            ['province_id', '=', $user->province_id],
        ])->count();
    }

    return $total_pendukung;
}
