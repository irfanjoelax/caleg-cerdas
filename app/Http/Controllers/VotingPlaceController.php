<?php

namespace App\Http\Controllers;

use App\Models\Neighbourhood;
use App\Models\VotingPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class VotingPlaceController extends Controller
{
    public $textAlert = "Data TPS has been ";

    public function index(Request $request)
    {
        $places = VotingPlace::query();

        $user = Auth::user();

        if (Auth::user()->role == 'provinsi') {
            $places->where('province_id', $user->province_id);
        }

        if (Auth::user()->role == 'kota') {
            $places->where('regency_id', $user->regency_id);
        }

        if (Auth::user()->role == 'kecamatan') {
            $places->where('district_id', $user->district_id);
        }

        if (Auth::user()->role == 'kelurahan') {
            $places->where('village_id', $user->village_id);
        }

        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $places->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.voting_place.index', [
            'request' => $request->all(),
            'places'  => $places->orderBy('name')->paginate(10),
        ]);
    }

    public function create()
    {
        $village_id = Auth::user()->village_id;

        return view('pages.voting_place.form', [
            'isEdit'    => false,
            'url'       => route('voting-place.store'),
            'neighbourhoods' => Neighbourhood::where('village_id', $village_id)->orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        VotingPlace::create([
            'name'             => Str::upper($request->name),
            'neighbourhood_id' => $request->neighbourhood_id,
            'village_id'       => Auth::user()->village_id,
            'district_id'      => Auth::user()->district_id,
            'regency_id'       => Auth::user()->regency_id,
            'province_id'      => Auth::user()->province_id,
            'total_dpt'        => $request->total_dpt,
        ]);

        Alert::success('Created', $this->textAlert . 'created');

        return redirect()->route('voting-place.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $village_id = Auth::user()->village_id;
        $data = VotingPlace::findOrFail($id);

        return view('pages.voting_place.form', [
            'isEdit'    => true,
            'url'       => route('voting-place.update', ['voting_place' => $id]),
            'data'      => $data,
            'neighbourhoods' => Neighbourhood::where('village_id', $village_id)->orderBy('name')->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        VotingPlace::findOrFail($id)->update([
            'name'         => Str::upper($request->name),
            'neighbourhood_id'   => $request->neighbourhood_id,
            'total_dpt'   => $request->total_dpt,
        ]);

        Alert::info('Updated', $this->textAlert . 'updated');

        return redirect()->route('voting-place.index');
    }

    public function destroy($id)
    {
        VotingPlace::findOrFail($id)->delete();

        Alert::error('Delete', $this->textAlert . 'deleted');

        return redirect()->route('voting-place.index');
    }
}
