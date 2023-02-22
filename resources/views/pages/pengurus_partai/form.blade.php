@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Pengurus Partai</h2>
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
                        <label for="name" class="col-sm-3 col-form-label">Nama Kepengurusan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="Masukkan Nama ..."
                                value="{{ $isEdit ? $data->name : old('name') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="position" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="position" placeholder="Masukkan Nama Jabatan"
                                value="{{ $isEdit ? $data->position : old('position') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="order" class="col-sm-3 col-form-label">Order</label>
                        <div class="col-sm-4">
                            <input type="numeric" class="form-control" name="order" placeholder="0"
                                value="{{ $isEdit ? $data->order : old('order') }}" required>
                        </div>
                    </div>

                    <div class="row mt-lg-4 mt-3">
                        <div class="col-12 d-flex gap-2 justify-content-md-end justify-content-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                <span class="ms-1">{{ $isEdit ? 'Update' : 'Save' }}</span>
                            </button>
                            <a href="{{ route('pengurus-partai.index') }}" class="btn btn-warning">
                                <i class="bi bi-arrow-90deg-left"></i>
                                <span class="ms-1">Back</span>
                            </a>
                            @if ($isEdit)
                                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="bi bi-x-lg"></i>
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
            url="{{ route('pengurus-partai.destroy', ['pengurus_partai' => $data->id]) }}" method="DELETE" />
    @endif
@endsection
