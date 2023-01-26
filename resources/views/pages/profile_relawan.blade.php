@extends('layouts.relawan')

@section('title')
    Profile
@endsection

@section('content')
    <form action="{{ route('profile.store') }}" class="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-lg" name="name" value="{{ Auth::user()->name }}"
                    required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control form-control-lg" name="email" value="{{ Auth::user()->email }}"
                    required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-lg" name="phone"
                    value="{{ Auth::user()->relawan->phone }}" required>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label for="email" class="col-sm-3 col-form-label">Kelamin</label>
            <div class="col-sm-9">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kelamin" id="pria" value="PRIA"
                        {{ Auth::user()->relawan->kelamin == 'PRIA' ? 'checked' : '' }}>
                    <label class="form-check-label" for="pria">Pria</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kelamin" id="wanita" value="WANITA"
                        {{ Auth::user()->relawan->kelamin == 'WANITA' ? 'checked' : '' }}>
                    <label class="form-check-label" for="wanita">Wanita</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control form-control-lg" name="password" placeholder="* * * * *">
                <small class="text-danger">
                    Kosongkan jika tidak ingin mengubah password
                </small>
            </div>
        </div>

        <div class="row mb-3">
            <label for="photo" class="col-sm-3 col-form-label">Photo</label>
            <div class="col-sm-9">
                <input type="file" class="form-control form-control-lg" name="photo">
            </div>
            <div class="mt-3 rounded-3">
                <img src="{{ Auth::user()->relawan->photo == 'img/avatar.svg' ? asset('img/avatar.svg') : asset('storage/' . Auth::user()->relawan->photo) }}"
                    width="75" class="img-fluid rounded-circle">
            </div>
        </div>

        <button type="submit" class="btn btn-lg btn-primary w-100">
            <i class="fa-regular fa-circle-check"></i>
            <span class="ms-1">Update</span>
        </button>

        <button type="button" class="btn btn-lg btn-outline-danger w-100 mt-3" data-bs-toggle="modal"
            data-bs-target="#logoutModal">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="ms-1">Keluar</span>
        </button>
    </form>

    <x-modal-confirm id="logoutModal" text="Are you sure for logout from this application ?" url="{{ route('logout') }}" />
@endsection
