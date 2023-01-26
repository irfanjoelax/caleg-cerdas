<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use Illuminate\Http\Request;

class GetDistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $districts = District::query();

        if ($request->has('regency_id')) {
            $districts->where('regency_id', $request->regency_id);
        }

        if ($request->has('keyword')) {
            $districts->where('name', 'like', '%' . $request->keyword . '%');
        }

        return DistrictResource::collection($districts->orderBy('name')->get());
    }
}
