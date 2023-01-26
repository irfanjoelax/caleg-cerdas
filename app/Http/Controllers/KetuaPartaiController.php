<?php

namespace App\Http\Controllers;

use App\Models\KetuaPartai;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaPartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KetuaPartai $ketua_partais)
    {
        $keyword = $request->input('keyword');

        $ketua_partais = $ketua_partais->when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        })->with('district', 'sub_district')->orderBy('id', 'DESC')->paginate(10);

        $request = $request->all();

        $user  = Auth::user();
        $role  = $user->role;
        $level = Level::findOrFail($user->id);

        if($role == 'province') {
            
        }

        $edit_url = route('ketua-partai.edit', ['ketua_partai' => $level->province_id]);
        dd($level->province_id);


        // return view('pages.ketua_partai.index', [
        //     'request'       => $request,
        //     'ketua_partais' => $ketua_partais,
        //     'edit_url'      => $edit_url
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ketua_partai.form', [
            'isEdit'    => false,
            'url'       => route('ketua-partai.store'),
            'cities'    => City::whereNotIn('id', [1])->latest()->get(),
            'districts' => District::whereNotIn('id', [1])->latest()->get(),
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
        ketua_partai::create([
            'city_id'     => $request->city_id,
            'district_id' => $request->district_id,
            'name'        => $request->name,
        ]);

        Alert::success('Create', 'Sub District has been been created');

        return redirect()->route('ketua-partai.index');
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
        return view('pages.ketua_partai.form', [
            'isEdit'    => true,
            'url'       => route('ketua-partai.update', ['ketua_partai' => $id]),
            'data'      => ketua_partai::findOrFail($id),
            'cities'    => City::whereNotIn('id', [1])->latest()->get(),
            'districts' => District::whereNotIn('id', [1])->latest()->get(),
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
        ketua_partai::findOrFail($id)->update([
            'city_id'     => $request->city_id,
            'district_id' => $request->district_id,
            'name'        => $request->name,
        ]);

        Alert::info('Update', 'Sub District has been been updated');

        return redirect()->route('ketua-partai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ketua_partai::findOrFail($id)->delete();

        Alert::error('Delete', 'Sub District has been been deleted');

        return redirect()->route('ketua-partai.index');
    }
}
