<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class NeighbourhoodController extends Controller
{
    public $textAlert = "Rukun Tetangga has been ";

    public function index(Request $request)
    {
        $neighbourhoods = Neighbourhood::query();

        $user = Auth::user();

        if (Auth::user()->role == 'provinsi') {
            $neighbourhoods->where('province_id', $user->province_id);
        }

        if (Auth::user()->role == 'kota') {
            $neighbourhoods->where('regency_id', $user->regency_id);
        }

        if (Auth::user()->role == 'kecamatan') {
            $neighbourhoods->where('district_id', $user->district_id);
        }

        if (Auth::user()->role == 'kelurahan') {
            $neighbourhoods->where('village_id', $user->village_id);
        }

        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $neighbourhoods->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.neighbourhood.index', [
            'request'        => $request->all(),
            'neighbourhoods' => $neighbourhoods->with('village')->orderBy('name')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.neighbourhood.form', [
            'isEdit'    => false,
            'url'       => route('neighbourhood.store'),
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
        Neighbourhood::create([
            'name'        => Str::upper($request->name),
            'village_id'  => Auth::user()->village_id,
            'district_id' => Auth::user()->district_id,
            'regency_id'  => Auth::user()->regency_id,
            'province_id' => Auth::user()->province_id,
        ]);

        Alert::success('Created', $this->textAlert . 'created');

        return redirect()->route('neighbourhood.index');
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
        $data = Neighbourhood::findOrFail($id);

        return view('pages.neighbourhood.form', [
            'isEdit'    => true,
            'url'       => route('neighbourhood.update', ['neighbourhood' => $id]),
            'data'      => $data,
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
        Neighbourhood::findOrFail($id)->update([
            'name'         => Str::upper($request->name),
            'village_id'   => Auth::user()->village_id,
        ]);

        Alert::info('Updated', $this->textAlert . 'updated');

        return redirect()->route('neighbourhood.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Neighbourhood::findOrFail($id)->delete();

        Alert::error('Delete', $this->textAlert . 'deleted');

        return redirect()->route('neighbourhood.index');
    }
}
