<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class RelawanController extends Controller
{
    public $textAlert = "Relawan has been ";

    public function index(Request $request)
    {
        $user = Auth::user();

        $users = User::query();

        if (Auth::user()->role == 'provinsi') {
            $users->where('province_id', $user->province_id);
        }

        if (Auth::user()->role == 'kota') {
            $users->where('regency_id', $user->regency_id);
        }

        if ($user->role == 'kecamatan') {
            $users->where('district_id', $user->district_id);
        }

        if ($user->role == 'kelurahan') {
            $users->where('village_id', $user->village_id);
        }

        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $users->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.relawan.index', [
            'request' => $request->all(),
            'users'   => $users->with('relawan')->orderBy('name')->where('role', 'relawan')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('pages.relawan.form', [
            'isEdit' => false,
            'url'    => route('relawan.store'),
        ]);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->password    = bcrypt($request->password);
        $user->role        = 'relawan';
        $user->province_id = Auth::user()->province_id;
        $user->regency_id  = Auth::user()->regency_id;
        $user->district_id = Auth::user()->district_id;
        $user->village_id  = Auth::user()->village_id;
        $user->save();

        Relawan::create([
            'user_id' => $user->id,
            'kelamin' => $request->kelamin,
            'phone'   => $request->phone,
        ]);

        Alert::success('Created', $this->textAlert . 'created');

        return redirect()->route('relawan.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('pages.relawan.form', [
            'isEdit' => true,
            'url'    => route('relawan.update', ['relawan' => $id]),
            'data'   => User::with('relawan')->findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->update();

        Relawan::where('user_id', $user->id)->update([
            'kelamin' => $request->kelamin,
            'phone'   => $request->phone,
        ]);

        Alert::success('Updated', $this->textAlert . 'updated');

        return redirect()->route('relawan.index');
    }

    public function destroy($id)
    {
        Relawan::where('user_id', $id)->first()->delete();

        User::findOrFail($id)->delete();

        Alert::error('Deleted', $this->textAlert . 'deleted');

        return redirect()->route('relawan.index');
    }
}
