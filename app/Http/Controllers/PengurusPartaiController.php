<?php

namespace App\Http\Controllers;

use App\Models\PengurusPartai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PengurusPartaiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $pengurus = PengurusPartai::query();

        if (Auth::user()->role == 'provinsi') {
            $pengurus->where('province_id', Auth::user()->province_id);
        }

        if (Auth::user()->role == 'kota') {
            $pengurus->where('regency_id', Auth::user()->regency_id);
        }

        if (Auth::user()->role == 'kecamatan') {
            $pengurus->where('district_id', Auth::user()->district_id);
        }

        if ($request->has('keyword')) {
            $pengurus->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.pengurus_partai.index', [
            'request'  => $request->all(),
            'pengurus' => $pengurus->orderBy('order')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('pages.pengurus_partai.form', [
            'isEdit'    => false,
            'url'       => route('pengurus-partai.store'),
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $pengurus = new PengurusPartai();

        $pengurus->name = Str::upper($request->name);
        $pengurus->position = Str::upper($request->position);
        $pengurus->order = $request->order;

        if ($user->role === 'provinsi') {
            $pengurus->province_id = $user->province_id;
        }

        if ($user->role === 'kota') {
            $pengurus->regency_id = $user->regency_id;
        }

        if ($user->role === 'kecamatan') {
            $pengurus->district_id = $user->district_id;
        }

        $pengurus->save();

        Alert::success('Created', 'Pengurus partai has been been created');

        return redirect()->route('pengurus-partai.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = PengurusPartai::findOrFail($id);

        return view('pages.pengurus_partai.form', [
            'isEdit'    => true,
            'url'       => route('pengurus-partai.update', ['pengurus_partai' => $id]),
            'data'      => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        PengurusPartai::findOrFail($id)->update([
            'name'        => Str::upper($request->name),
            'position'    => Str::upper($request->position),
            'order'       => $request->order,
        ]);

        Alert::info('Updated', 'Pengurus partai has been been updated');

        return redirect()->route('pengurus-partai.index');
    }

    public function destroy($id)
    {
        PengurusPartai::findOrFail($id)->delete();

        Alert::error('Delete', 'Pengurus partai has been been deleted');

        return redirect()->route('pengurus-partai.index');
    }
}
