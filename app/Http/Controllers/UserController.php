<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Regency;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public $textAlert = "User kelurahan has been ";

    public function __autoload()
    {
        $data  = [];
        $user  = Auth::user();
        $users = User::query();

        if ($user->role == 'provinsi') {
            $data['title'] = 'Kota/Kabupaten';
            $data['role']  = 'kota';
            $data['users'] = $users->where('province_id', $user->province_id);
            $data['areas'] = Regency::where('province_id', Auth::user()->province_id)->orderBy('name')->get();
        }

        if ($user->role == 'kota') {
            $data['title'] = 'Kecamatan';
            $data['role']  = 'kecamatan';
            $data['users'] = $users->where('regency_id', $user->regency_id);
            $data['areas'] = District::where('regency_id', Auth::user()->regency_id)->orderBy('name')->get();
        }

        if ($user->role == 'kecamatan') {
            $data['title'] = 'Kelurahan';
            $data['role']  = 'kelurahan';
            $data['users'] = $users->where('district_id', $user->district_id);
            $data['areas'] = Village::where('district_id', Auth::user()->district_id)->orderBy('name')->get();
        }

        if ($user->role == 'kelurahan') {
            $data['users'] = $users->where('village_id', $user->village_id);
        }

        return $data;
    }

    public function index(Request $request)
    {
        $config = $this->__autoload();

        $users  = $config['users'];

        $keyword = $request->input('keyword');

        if ($request->has('keyword')) {
            $users->where('name', 'like', '%' . $keyword . '%');
        }

        return view('pages.user.index', [
            'request' => $request->all(),
            'users'   => $users->orderBy('name')->where('role', $config['role'])->paginate(10),
            'title'   => $config['title'],
        ]);
    }

    public function create()
    {
        $config = $this->__autoload();

        return view('pages.user.form', [
            'isEdit' => false,
            'url'    => route('user.store'),
            'title'  => $config['title'],
            'areas'  => $config['areas'],
        ]);
    }

    public function store(Request $request)
    {
        $config = $this->__autoload();
        $auth = Auth::user()->role;

        $user = new User();
        $user->name        = $request->name;
        $user->email       = $request->email;
        $user->password    = bcrypt('123456');
        $user->role        = $config['role'];
        $user->village_id  = $auth == 'kecamatan' ? $request->area_id : Auth::user()->village_id;
        $user->district_id = $auth == 'kota' ? $request->area_id : Auth::user()->district_id;
        $user->regency_id  = $auth == 'provinsi' ? $request->area_id : Auth::user()->regency_id;
        $user->province_id = Auth::user()->province_id;
        $user->save();

        Alert::success('Created', $this->textAlert . 'created');

        return redirect()->route('user.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $config = $this->__autoload();

        return view('pages.user.form', [
            'isEdit' => true,
            'url'    => route('user.update', ['user' => $id]),
            'title'  => $config['title'],
            'data'   => User::findOrFail($id),
            'areas'  => $config['areas'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $config = $this->__autoload();

        $user = User::findOrFail($id);
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->village_id = $request->village_id;
        $user->update();

        Alert::success('Updated', $this->textAlert . 'updated');

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        Alert::error('Deleted', $this->textAlert . 'deleted');

        return redirect()->route('user.index');
    }
}
