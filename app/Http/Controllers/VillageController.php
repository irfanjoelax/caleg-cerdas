<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Neighbourhood;
use App\Models\Province;
use App\Models\Village;
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
                return $query->where('regency_id', $user->regency_id);
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
}
