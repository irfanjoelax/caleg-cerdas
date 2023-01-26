<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VillageResource;
use App\Models\Village;
use Illuminate\Http\Request;

class GetVillageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $villages = Village::query();
        $message  = 'List village';

        if ($request->has('district_id')) {
            $villages->where('district_id', $request->district_id);
            $message .= ' by district_id';
        }

        if ($request->has('keyword')) {
            $villages->where('name', 'like', '%' . $request->keyword . '%');
            $message .= ' with keyword';
        }

        $data = VillageResource::collection($villages->orderBy('name')->get());

        if ($data->isEmpty()) {
            $message .= ' not found or has empty';
        }

        return response()->json([
            'message' => $message,
            'data'    => $data,
        ]);
    }
}
