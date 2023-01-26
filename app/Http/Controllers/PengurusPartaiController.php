<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\PengurusPartai;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PengurusPartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PengurusPartai $pengurus)
    {
        $keyword = $request->input('keyword');

        $pengurus = $pengurus->when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('ketua_partai', 'like', '%' . $keyword . '%');
        })->orderBy('province_id')->paginate(10);

        $request = $request->all();

        return view('pages.pengurus_partai.index', [
            'request'  => $request,
            'pengurus' => $pengurus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengurus_partai.form', [
            'isEdit'    => false,
            'url'       => route('pengurus-partai.store'),
            'provinces' => Province::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PengurusPartai::create([
            'province_id'  => $request->province_id,
            'regency_id'   => $request->regency_id,
            'district_id'  => $request->district_id,
            'village_id'   => $request->village_id,
            'name'         => Str::upper($request->name),
            'ketua_partai' => Str::upper($request->ketua_partai),
        ]);

        Alert::success('Created', 'Pengurus partai has been been created');

        return redirect()->route('pengurus-partai.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PengurusPartai::findOrFail($id);

        return view('pages.pengurus_partai.form', [
            'isEdit'    => true,
            'url'       => route('pengurus-partai.update', ['pengurus_partai' => $id]),
            'data'      => $data,
            'provinces' => Province::orderBy('name')->get(),
            'regencies' => Regency::where('province_id', $data->province_id)->get(),
            'districts' => District::where('regency_id', $data->regency_id)->get(),
            'villages'  => Village::where('id', $data->village_id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        PengurusPartai::findOrFail($id)->update([
            'province_id'  => $request->province_id,
            'regency_id'   => $request->regency_id,
            'district_id'  => $request->district_id,
            'village_id'   => $request->village_id,
            'name'         => Str::upper($request->name),
            'ketua_partai' => Str::upper($request->ketua_partai),
        ]);

        Alert::info('Updated', 'Pengurus partai has been been updated');

        return redirect()->route('pengurus-partai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PengurusPartai::findOrFail($id)->delete();

        Alert::error('Delete', 'Pengurus partai has been been deleted');

        return redirect()->route('pengurus-partai.index');
    }
}
