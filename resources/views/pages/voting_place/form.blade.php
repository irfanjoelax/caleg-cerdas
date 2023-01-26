@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Data TPS</h2>
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
                            <input type="text" class="form-control" name="name" placeholder="Enter Data TPS"
                                value="{{ $isEdit ? $data->name : old('name') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="neighbourhood_id" class="col-sm-2 col-form-label">Data RT</label>
                        <div class="col-sm-5">
                            <select name="neighbourhood_id" class="form-select" required>
                                @if (!$isEdit)
                                    <option value="" selected>CHOOSE DATA RT</option>
                                @endif

                                @foreach ($neighbourhoods as $neighbourhood)
                                    <option value="{{ $neighbourhood->id }}"
                                        @if ($isEdit) {{ $neighbourhood->id == $data->neighbourhood_id ? 'selected' : '' }} @endif>
                                        {{ $neighbourhood->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="total_dpt" class="col-sm-2 col-form-label">Total DPT</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" name="total_dpt" placeholder="0"
                                value="{{ $isEdit ? $data->total_dpt : old('total_dpt') }}" required>
                        </div>
                    </div>

                    <div class="row mt-lg-4 mt-3">
                        <div class="col-12 text-lg-end text-md-end text-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-regular fa-circle-check"></i>
                                <span class="ms-1">{{ $isEdit ? 'Update' : 'Save' }}</span>
                            </button>
                            <a href="{{ route('voting-place.index') }}" class="btn btn-warning">
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
            url="{{ route('voting-place.destroy', ['voting_place' => $data->id]) }}" method="DELETE" />
    @endif
@endsection
