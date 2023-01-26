@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Kecamatan</h2>
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
                            <input type="text" class="form-control" name="name" placeholder="Enter Name Kecamatan"
                                value="{{ $isEdit ? $data->name : old('name') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="name" class="col-sm-2 col-form-label">Target Suara</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="target_suara" placeholder="0"
                                value="{{ $isEdit ? $data->target_suara : old('target_suara') }}" required>
                        </div>
                    </div>

                    {{-- <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="city_id" class="col-sm-2 col-form-label">Kota/Kabupaten</label>
                        <div class="col-sm-10">
                            <select name="city_id" class="form-select" required>
                                @if (!$isEdit)
                                    <option value="" selected>Choose Kota/Kabupaten</option>
                                @endif

                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        @if ($isEdit) {{ $city->id == $data->city_id ? 'selected' : '' }} @endif>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div> --}}

                    <div class="row mt-lg-4 mt-3">
                        <div class="col-12 text-lg-end text-md-end text-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-regular fa-circle-check"></i>
                                <span class="ms-1">{{ $isEdit ? 'Update' : 'Save' }}</span>
                            </button>
                            <a href="{{ route('district.index') }}" class="btn btn-warning">
                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                <span class="ms-1">Back</span>
                            </a>
                            {{-- @if ($isEdit)
                                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fa-solid fa-xmark"></i>
                                    <span class="ms-1">Delete</span>
                                </button>
                            @endif --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @if ($isEdit)
        <x-modal-confirm id="deleteModal" text="Are you sure for delete this data ?"
            url="{{ route('district.destroy', ['district' => $data->id]) }}" method="DELETE" />
    @endif --}}
@endsection
