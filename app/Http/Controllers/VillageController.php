<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Village;
use App\Models\Neighbourhood;
use App\Models\Pendukung;
use App\Models\User;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VillageController extends Controller
{
    public function index(Request $request)
    {

        $villages = Village::query()->with('district');

        $user = Auth::user();

        if ($user->role == 'provinsi') {
            $villages = Province::where('id', $user->province_id)->first()->villages->toQuery();
        }

        if ($user->role == 'kota') {
            $villages->whereHas('district', function ($query) use ($user) {
                return $query->where('village_id', $user->village_id);
            });
        }

        if ($user->role == 'kecamatan') {
            $villages->where('district_id', $user->district_id);
        }

        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $villages->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.village.index', [
            'request'  => $request->all(),
            'villages' => $villages->orderBy('name')->paginate(10)
        ]);
    }

    public function show($id)
    {
        $village = Village::findOrFail($id);

        $totalNeighbourhood = Neighbourhood::where('village_id', $id)->count();

        $totalRelawan = User::with('relawan')->where([
            ['role', 'relawan'],
            ['village_id', $id],
        ])->count();

        $totalTPS = VotingPlace::where('village_id', $id)->count();

        $totalDPT = VotingPlace::where('village_id', $id)->sum('total_dpt');

        $totalPendukung = Pendukung::where('village_id', $id)->count();

        return view('pages.village.show', compact(
            'village',
            'totalNeighbourhood',
            'totalRelawan',
            'totalTPS',
            'totalDPT',
            'totalPendukung',
        ));
    }
}
