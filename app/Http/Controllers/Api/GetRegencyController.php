<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegencyResource;
use App\Models\Regency;
use Illuminate\Http\Request;

class GetRegencyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $regencies = Regency::query();

        if ($request->has('province_id')) {
            $regencies->where('province_id', $request->province_id);
        }

        if ($request->has('keyword')) {
            $regencies->where('name', 'like', '%' . $request->keyword . '%');
        }

        return RegencyResource::collection($regencies->orderBy('name')->get());
    }
}
