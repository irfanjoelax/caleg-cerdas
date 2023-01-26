<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NeighbourhoodResource;
use App\Models\Neighbourhood;
use Illuminate\Http\Request;

class NeighbourhoodController extends Controller
{
    public $textAlert = "Neighbourhood has been";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $neighbourhoods = Neighbourhood::query();
        $message        = 'List neighbourhood';

        if ($request->has('village_id')) {
            $neighbourhoods->where('village_id', $request->village_id);
            $message .= ' by village_id';
        }

        if ($request->has('keyword')) {
            $neighbourhoods->where('name', 'like', '%' . $request->keyword . '%');
            $message .= ' with keyword';
        }

        $data = NeighbourhoodResource::collection($neighbourhoods->orderBy('name')->get());

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
        $request->validate([
            'name'       => 'required',
            'village_id' => 'required',
        ]);

        Neighbourhood::create([
            'name'       => $request->name,
            'village_id' => $request->village_id
        ]);

        return response()->json([
            'message' => $this->textAlert . ' created',
        ]);
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
        $request->validate([
            'name'       => 'required',
            'village_id' => 'required',
        ]);

        Neighbourhood::findOrFail($id)->update([
            'name'       => $request->name,
            'village_id' => $request->village_id
        ]);

        return response()->json([
            'message' => $this->textAlert . ' updated',
        ]);
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

        return response()->json([
            'message' => $this->textAlert . ' deleted',
        ]);
    }
}
