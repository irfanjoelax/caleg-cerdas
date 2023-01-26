<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengurusPartaiResource;
use App\Models\PengurusPartai;
use Illuminate\Http\Request;

class PengurusPartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pengurus = PengurusPartai::with('province', 'regency', 'district', 'village');
        $message  = 'List pengurus partai';

        // if ($request->has('village_id')) {
        //     $pengurus->where('village_id', $request->village_id);
        //     $message .= ' by village_id';
        // }

        if ($request->has('keyword')) {
            $pengurus->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('ketua_partai', 'like', '%' . $request->keyword . '%');

            $message .= ' with keyword';
        }

        $data = PengurusPartaiResource::collection($pengurus->orderBy('province_id')->get());

        if ($data->isEmpty()) {
            $message .= ' not found or has empty';
        }

        return response()->json([
            'message' => $message,
            'data'    => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
