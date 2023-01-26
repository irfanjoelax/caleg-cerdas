@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Profile</h2>
                    <h6 class="m-0 text-muted fw-semibold">Update Your Informations</h6>
                </div>
            </div>

            <div class="col-12 mt-lg-4 mt-md-3 mt-sm-2 mt-2">
                <form action="{{ route('profile.store') }}" class="bg-white p-4 shadow-sm rounded-4" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" placeholder="* * * * *">
                            <small class="text-danger">
                                Leave blank if you don't want to change your password.
                            </small>
                        </div>
                    </div>

                    <div class="row mt-lg-4 mt-3">
                        <div class="col-12 text-lg-end text-md-end text-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-regular fa-circle-check"></i>
                                <span class="ms-1">Update</span>
                            </button>
                            @if (url()->previous() !== url()->current())
                                <a href="{{ url()->previous() }}" class="btn btn-warning">
                                    <i class="fa-solid fa-arrow-rotate-left"></i>
                                    <span class="ms-1">Back</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
