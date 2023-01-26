<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Neighbourhood;
use App\Models\Pendukung;
use App\Models\Regency;
use App\Models\Relawan;
use App\Models\User;
use App\Models\Village;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegencyController extends Controller
{
    public function index(Request $request)
    {
        $regencies = Regency::query();

        $user = Auth::user();

        if ($user->role == 'provinsi') {
            $regencies->where('province_id', $user->province_id);
        }

        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $regencies->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.regency.index', [
            'request'  => $request->all(),
            'regencies' => $regencies->orderBy('name')->paginate(10)
        ]);
    }

    public function show($id)
    {
        $regency = Regency::findOrFail($id);

        $totalDistrict = District::where('regency_id', $id)->count();

        $totalVillage = Village::whereHas('district', function ($query) use ($id) {
            return $query->where('regency_id', $id);
        })->count();

        $totalNeighbourhood = Neighbourhood::where('regency_id', $id)->count();

        $totalRelawan = User::with('relawan')->where([
            ['role', 'relawan'],
            ['regency_id', $id],
        ])->count();

        $totalTPS = VotingPlace::where('regency_id', $id)->count();

        $totalDPT = VotingPlace::where('regency_id', $id)->sum('total_dpt');

        $totalPendukung = Pendukung::where('regency_id', $id)->count();

        $totalTargetSuara = District::where('regency_id', $id)->sum('target_suara');

        return view('pages.regency.show', compact(
            'regency',
            'totalDistrict',
            'totalVillage',
            'totalNeighbourhood',
            'totalRelawan',
            'totalTPS',
            'totalDPT',
            'totalPendukung',
            'totalTargetSuara',
        ));
    }
}
