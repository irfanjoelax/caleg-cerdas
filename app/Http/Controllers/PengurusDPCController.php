<?php

namespace App\Http\Controllers;

use App\Models\PengurusDpcKotaKab;
use App\Models\Regency;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengurusDPCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pengurusDPC = PengurusDpcKotaKab::query();
        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $pengurusDPC->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.pengurus_dpc_kota_kab.index', [
            'request'  => $request->all(),
            'pengurusDPC' => $pengurusDPC->orderBy('regency_id')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regency = Regency::pluck('name', 'id');
        return view('pages.pengurus_dpc_kota_kab.form', [
            'isEdit' => false,
            'url'    => route('pengurusDPC.store'),
            'regency'=> $regency
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
        // return $request;
        $pengurus = PengurusDpcKotaKab::where('regency_id', $request['regency_id'])->first();
        if($pengurus == null){
            PengurusDpcKotaKab::create([
                'regency_id'  => $request->regency_id,
                'pengurus'   => $request->pengurus,
            ]);
            Alert::success('Created', 'Pengurus DPC Kab/Kota has been been created');
            return redirect()->route('pengurusDPC.index');
        } else {
            Alert::warning('Warning', 'Pengurus DPC Kab/Kota Sudah Ada');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengurusDpcKotaKab  $pengurusDpcKotaKab
     * @return \Illuminate\Http\Response
     */
    public function show(PengurusDpcKotaKab $pengurusDpcKotaKab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengurusDpcKotaKab  $pengurusDpcKotaKab
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengurusDPC = PengurusDpcKotaKab::find($id);
        $regency = Regency::pluck('name', 'id');

        return view('pages.pengurus_dpc_kota_kab.form', [
            'isEdit' => true,
            'url'    => route('pengurusDPC.update', ['pengurusDPC' => $pengurusDPC['id']]),
            'regency'=> $regency
        ])->with('pengurusDPC', $pengurusDPC); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengurusDpcKotaKab  $pengurusDpcKotaKab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $pengurusDPC = PengurusDpcKotaKab::findOrFail($id);
        $pengurusDPC['regency_id'] = $request['regency_id'];
        $pengurusDPC['pengurus'] = $request['pengurus'];
        $pengurusDPC->update();

        Alert::success('Updated', 'Pengurus DPC Kab/Kota has been been updated');
        return redirect()->route('pengurusDPC.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengurusDpcKotaKab  $pengurusDpcKotaKab
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PengurusDpcKotaKab::findOrFail($id)->delete();

        Alert::error('Deleted', 'Data Pengurus DPC Kab/Kota Telah Dihapus');
        return redirect()->route('pengurusDPC.index');
    }
}
