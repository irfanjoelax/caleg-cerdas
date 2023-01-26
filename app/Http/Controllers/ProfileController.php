<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $view = 'pages.profile';

        // ROLE RELAWAN
        if (Auth::user()->role == 'relawan') {
            $view = 'pages.profile_relawan';
        }

        return view($view);
    }

    public function store(Request $request)
    {
        $user     = Auth::user();
        $password = $user->password;

        if ($request->password != NULL) {
            $password = bcrypt($request->password);
        }

        User::findOrFail($user->id)->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $password,
        ]);

        if ($user->role == 'relawan') {
            $relawan = Relawan::where('user_id', $user->id)->first();

            $photo = $relawan->photo;

            if ($request->has('photo')) {
                if ($relawan->photo != 'img/avatar.svg') {
                    Storage::delete($relawan->photo);
                }

                $photo = $request->file('photo')->store('relawan/photo');
            }

            $relawan->update([
                'kelamin' => $request->kelamin,
                'phone'   => $request->phone,
                'photo'   => $photo,
            ]);
        }

        Alert::success('Success', 'Your profile has been updated');

        return redirect()->back();
    }
}
