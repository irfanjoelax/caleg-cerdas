<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $districts = District::query();

        $user = Auth::user();

        if ($user->role == 'provinsi') {
            $districts->whereHas('regency', function ($query) use ($user) {
                return $query->where('province_id', $user->province_id);
            });
        }

        if ($user->role == 'kota') {
            $districts->where('regency_id', $user->regency_id);
        }

        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $districts->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.district.index', [
            'request'  => $request->all(),
            'districts' => $districts->orderBy('name')->paginate(10)
        ]);
    }

    public function edit($id)
    {
        return view('pages.district.form', [
            'isEdit' => true,
            'url'    => route('district.update', ['district' => $id]),
            'data'   => District::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        District::findOrFail($id)->update([
            'name' => Str::upper($request->name),
            'target_suara' => $request->target_suara
        ]);

        Alert::success('Success', 'Your District (Kecamatan) has been updated');

        return redirect()->route('district.index');
    }
}
