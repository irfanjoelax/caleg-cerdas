<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CalegController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $caleg = Caleg::query();

        if (Auth::user()->role == 'provinsi') {
            $caleg->where('province_id', Auth::user()->province_id);
        }

        if (Auth::user()->role == 'kota') {
            $caleg->where('regency_id', Auth::user()->regency_id);
        }

        if (Auth::user()->role == 'kecamatan') {
            $caleg->where('district_id', Auth::user()->district_id);
        }

        if ($request->has('keyword')) {
            $caleg->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.caleg.index', [
            'request' => $request->all(),
            'caleg'   => $caleg->orderBy('urutan')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('pages.caleg.form', [
            'isEdit'    => false,
            'url'       => route('caleg.store'),
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $caleg = new Caleg();

        $caleg->name = Str::upper($request->name);
        $caleg->urutan = $request->urutan;

        if ($user->role === 'provinsi') {
            $caleg->province_id = $user->province_id;
        }

        if ($user->role === 'kota') {
            $caleg->regency_id = $user->regency_id;
        }

        if ($user->role === 'kecamatan') {
            $caleg->district_id = $user->district_id;
        }

        $caleg->save();

        Alert::success('Created', 'caleg has been been created');

        return redirect()->route('caleg.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Caleg::findOrFail($id);

        return view('pages.caleg.form', [
            'isEdit'    => true,
            'url'       => route('caleg.update', ['caleg' => $id]),
            'data'      => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        Caleg::findOrFail($id)->update([
            'name'  => Str::upper($request->name),
            'urutan' => $request->urutan,
        ]);

        Alert::info('Updated', 'caleg has been been updated');

        return redirect()->route('caleg.index');
    }

    public function destroy($id)
    {
        Caleg::findOrFail($id)->delete();

        Alert::error('Delete', 'caleg has been been deleted');

        return redirect()->route('caleg.index');
    }
}
