@extends('layouts.relawan')

@section('title')
    {{ $isEdit ? 'Edit' : 'Create' }} Pendukung
@endsection

@section('content')
    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
        @csrf @if ($isEdit)
            @method('PUT')
        @endif

        <div class="row mb-lg-4 mb-md-3 mb-2">
            <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Nama Lengkap"
                    value="{{ $isEdit ? $data->name : old('name') }}" required>
            </div>
        </div>

        <div class="row mb-lg-4 mb-md-3 mb-2 align-items-center">
            <label for="email" class="col-sm-2 col-form-label">Kelamin</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kelamin" id="pria" value="PRIA"
                        @if ($isEdit) {{ $data->relawan->kelamin == 'PRIA' ? 'checked' : '' }} @endif>
                    <label class="form-check-label" for="pria">Pria</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kelamin" id="wanita" value="WANITA"
                        @if ($isEdit) {{ $data->relawan->kelamin == 'WANITA' ? 'checked' : '' }} @endif>
                    <label class="form-check-label" for="wanita">Wanita</label>
                </div>
            </div>
        </div>

        <div class="row mb-lg-4 mb-md-3 mb-2">
            <label for="usia" class="col-sm-2 col-form-label">Usia</label>
            <div class="col-6">
                <div class="input-group">
                    <input type="number" class="form-control form-control-lg" name="usia" placeholder="0"
                        value="{{ $isEdit ? $data->usia : old('usia') }}" required>
                    <span class="input-group-text">Tahun</span>
                </div>
            </div>
        </div>

        <div class="row mb-lg-4 mb-md-3 mb-2">
            <label for="phone" class="col-sm-2 col-form-label">No. HP/WA</label>
            <div class="col-sm-5">
                <input type="tel" class="form-control form-control-lg" name="phone" placeholder="08..."
                    value="{{ $isEdit ? $data->relawan->phone : old('phone') }}" required>
            </div>
        </div>

        <div class="row mb-lg-4 mb-md-3 mb-2">
            <label for="ktp" class="col-sm-2 col-form-label">FOTO KTP</label>
            <div class="col-sm-10">
                <input type="file" class="form-control form-control-lg" name="ktp" {{ $isEdit ? '' : 'required' }}>
            </div>
            @if ($isEdit)
                <div class="mt-3 rounded-3">
                    <img src="{{ asset('storage/' . $data->ktp) }}" alt="" class="img-fluid rounded-4">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-lg btn-primary w-100 mt-3">
            <i class="fa-regular fa-circle-check"></i>
            <span class="ms-1">{{ $isEdit ? 'Update' : 'Save' }}</span>
        </button>

        @if ($isEdit)
            <button type="button" class="btn btn-lg btn-outline-danger w-100 mt-3" data-bs-toggle="modal"
                data-bs-target="#deleteModal">
                <i class="fa-solid fa-xmark"></i>
                <span class="ms-1">Delete</span>
            </button>
        @endif
    </form>

    @if ($isEdit)
        <x-modal-confirm id="deleteModal" text="Are you sure for delete this data ?"
            url="{{ route('pendukung.destroy', ['pendukung' => $data->id]) }}" method="DELETE" />
    @endif
@endsection
