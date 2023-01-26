<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

function sum_relawan($kelamin)
{
    $user = Auth::user();

    if ($user->role == 'kelurahan') {
        $total_relawan = User::where([
            ['role', '=', 'relawan'],
            ['village_id', '=', $user->village_id],
        ])->whereRelation('relawan', 'kelamin', $kelamin)->count();
    }

    if ($user->role == 'kecamatan') {
        $total_relawan = User::where([
            ['role', '=', 'relawan'],
            ['district_id', '=', $user->district_id],
        ])->whereRelation('relawan', 'kelamin', $kelamin)->count();
    }

    if ($user->role == 'kota') {
        $total_relawan = User::where([
            ['role', '=', 'relawan'],
            ['regency_id', '=', $user->regency_id],
        ])->whereRelation('relawan', 'kelamin', $kelamin)->count();
    }

    if ($user->role == 'provinsi') {
        $total_relawan = User::where([
            ['role', '=', 'relawan'],
            ['province_id', '=', $user->province_id],
        ])->whereRelation('relawan', 'kelamin', $kelamin)->count();
    }

    return $total_relawan;
}
