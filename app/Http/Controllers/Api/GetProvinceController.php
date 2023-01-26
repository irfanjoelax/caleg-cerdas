<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use Illuminate\Http\Request;

class GetProvinceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $regencies = Province::query();

        if ($request->has('keyword')) {
            $regencies->where('name', 'like', '%' . $request->keyword . '%');
        }

        return ProvinceResource::collection($regencies->orderBy('name')->get());
    }
}
