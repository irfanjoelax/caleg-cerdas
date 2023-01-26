<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request, Province $provinces)
    {
        $keyword = $request->input('keyword');

        $provinces = $provinces->when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        })->orderBy('id', 'DESC')->whereNotIn('id', [1])->paginate(10);

        $request = $request->all();

        return view('pages.province.index', [
            'request'   => $request,
            'provinces' => $provinces
        ]);
    }
}
