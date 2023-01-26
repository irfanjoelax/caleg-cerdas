@extends('layouts.app')

@section('content')

    @php
        function checkRole($role, $data)
        {
            if ($role == 'kota') {
                return $data->district_id;
            }
        
            if ($role == 'kecamatan') {
                return $data->village_id;
            }
        }
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">User {{ $title }}</h2>
                    <h6 class="m-0 text-muted fw-semibold">Detail Data</h6>
                </div>
            </div>

            <div class="col-12 mt-lg-4 mt-md-3 mt-sm-2 mt-2">
                @if ($errors->any())
                    <div class="alert alert-warning mb-3" role="alert">
                        <ul class="my-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ $url }}" class="bg-white p-4 shadow-sm rounded-4" method="POST">
                    @csrf @if ($isEdit)
                        @method('PUT')
                    @endif

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name"
                                placeholder="Enter Name User {{ $title }}"
                                value="{{ $isEdit ? $data->name : old('name') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" placeholder="Enter Email User"
                                value="{{ $isEdit ? $data->email : old('email') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="area_id" class="col-sm-2 col-form-label">{{ $title }}</label>
                        <div class="col-sm-10">
                            <select name="area_id" class="form-select">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        @if ($isEdit) {{ $area->id == checkRole(Auth::user()->role, $data) ? 'selected' : '' }} @endif>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="passsword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10 text-danger">
                            Password untuk User {{ $title }} baru: <strong>123456</strong>
                        </div>
                    </div>

                    <div class="row mt-lg-4 mt-3">
                        <div class="col-12 text-lg-end text-md-end text-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-regular fa-circle-check"></i>
                                <span class="ms-1">{{ $isEdit ? 'Update' : 'Save' }}</span>
                            </button>
                            <a href="{{ route('user.index') }}" class="btn btn-warning">
                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                <span class="ms-1">Back</span>
                            </a>
                            @if ($isEdit)
                                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-xmark"></i>
                                    <span class="ms-1">Delete</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($isEdit)
        <x-modal-confirm id="deleteModal" text="Are you sure for delete this data ?"
            url="{{ route('user.destroy', ['user' => $data->id]) }}" method="DELETE" />
    @endif
@endsection
