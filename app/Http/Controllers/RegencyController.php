<?php

namespace App\Http\Controllers;

use App\Models\Regency;
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
}
