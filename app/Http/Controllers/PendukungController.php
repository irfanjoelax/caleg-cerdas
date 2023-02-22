<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;
use App\Models\Pendukung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PendukungController extends Controller
{
    public $textAlert = "Pendukung has been ";

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $pendukungs = Pendukung::query();

        if ($request->has('keyword')) {
            $pendukungs->where('name', 'like', '%' . $keyword . '%');
        }

        // ROLE PROVINSI
        if (Auth::user()->role == 'provinsi') {

            $pendukungs->where('province_id', Auth::user()->province_id);

            return view('pages.pendukung.index', [
                'request'    => $request->all(),
                'pendukungs' => $pendukungs->orderBy('name')->paginate(10)
            ]);
        }

        // ROLE KOTA
        if (Auth::user()->role == 'kota') {

            $pendukungs->where('regency_id', Auth::user()->regency_id);

            return view('pages.pendukung.index', [
                'request'    => $request->all(),
                'pendukungs' => $pendukungs->orderBy('name')->paginate(10)
            ]);
        }

        // ROLE KECAMATAN
        if (Auth::user()->role == 'kecamatan') {

            $pendukungs->where('district_id', Auth::user()->district_id);

            return view('pages.pendukung.index', [
                'request'    => $request->all(),
                'pendukungs' => $pendukungs->orderBy('name')->paginate(10)
            ]);
        }

        // ROLE KELURAHAN
        if (Auth::user()->role == 'kelurahan') {

            $pendukungs->where('village_id', Auth::user()->village_id);

            return view('pages.pendukung.index', [
                'request'    => $request->all(),
                'pendukungs' => $pendukungs->orderBy('name')->paginate(10)
            ]);
        }

        // ROLE RELAWAN
        if (Auth::user()->role == 'relawan') {
            $pendukungs->where('relawan_id', Auth::user()->relawan->id);

            return view('pages.pendukung.index_relawan', [
                'request'    => $request->all(),
                'pendukungs' => $pendukungs->orderBy('name')->paginate(10)
            ]);
        }
    }

    public function create()
    {
        return view('pages.pendukung.form', [
            'isEdit'         => false,
            'url'            => route('pendukung.store'),
            'neighbourhoods' => Neighbourhood::where('village_id', Auth::user()->village_id)->orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $ktp = $request->file('ktp')->store('pendukung/ktp');

        Pendukung::create([
            'name'             => $request->name,
            'usia'             => $request->usia,
            'kelamin'          => $request->kelamin,
            'phone'            => $request->phone,
            'ktp'              => $ktp,
            'neighbourhood_id' => $request->neighbourhood_id,
            'relawan_id'       => Auth::user()->relawan->id,
            'village_id'       => Auth::user()->village_id,
            'district_id'      => Auth::user()->district_id,
            'regency_id'       => Auth::user()->regency_id,
            'province_id'      => Auth::user()->province_id,
        ]);

        Alert::success('Created', $this->textAlert . 'created');

        return redirect()->route('pendukung.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('pages.pendukung.form', [
            'isEdit' => true,
            'url'    => route('pendukung.update', ['pendukung' => $id]),
            'data'   => Pendukung::findOrFail($id),
            'neighbourhoods' => Neighbourhood::where('village_id', Auth::user()->village_id)->orderBy('name')->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $pendukung = Pendukung::findOrFail($id);
        $ktp = $pendukung->ktp;

        if ($request->has('ktp')) {
            Storage::delete($ktp);
            $ktp = $request->file('ktp')->store('pendukung/ktp');
        }

        $pendukung->update([
            'name'             => $request->name,
            'usia'             => $request->usia,
            'kelamin'          => $request->kelamin,
            'phone'            => $request->phone,
            'ktp'              => $ktp,
            'neighbourhood_id' => $request->neighbourhood_id,
            'relawan_id'       => Auth::user()->relawan->id,
        ]);

        Alert::success('Updated', $this->textAlert . 'updated');

        return redirect()->route('pendukung.index');
    }

    public function destroy($id)
    {
        $pendukung = Pendukung::findOrFail($id);

        Storage::delete($pendukung->ktp);

        $pendukung->delete();

        Alert::error('Deleted', $this->textAlert . 'deleted');

        return redirect()->route('pendukung.index');
    }
}
