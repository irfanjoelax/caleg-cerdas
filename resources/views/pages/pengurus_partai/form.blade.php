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
                            <input type="text" class="form-control" name="name" placeholder="Masukkan Dewan ..."
                                value="{{ $isEdit ? $data->name : old('name') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="ketua_partai" class="col-sm-3 col-form-label">Ketua Partai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ketua_partai"
                                placeholder="Masukkan Nama Ketua Partai"
                                value="{{ $isEdit ? $data->ketua_partai : old('ketua_partai') }}" required>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="province_id" class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-sm-9">
                            <select name="province_id" class="form-select" required>
                                @if (!$isEdit)
                                    <option value="" selected>CHOOSE PROVINSI</option>
                                @endif

                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}"
                                        @if ($isEdit) {{ $province->id == $data->province_id ? 'selected' : '' }} @endif>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="regency_id" class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                        <div class="col-sm-9">
                            <select name="regency_id" class="form-select">
                                @if ($isEdit)
                                    @if ($data->regency_id != null)
                                        @foreach ($regencies as $regency)
                                            <option value="{{ $regency->id }}"
                                                @if ($isEdit) {{ $regency->id == $data->regency_id ? 'selected' : '' }} @endif>
                                                {{ $regency->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="district_id" class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-sm-9">
                            <select name="district_id" class="form-select">
                                @if ($isEdit)
                                    @if ($data->district_id != null)
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}"
                                                @if ($isEdit) {{ $district->id == $data->district_id ? 'selected' : '' }} @endif>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-lg-4 mb-md-3 mb-2">
                        <label for="village_id" class="col-sm-3 col-form-label">Kelurahan</label>
                        <div class="col-sm-9">
                            <select name="village_id" class="form-select">
                                @if ($isEdit)
                                    @if ($data->village_id != null)
                                        @foreach ($villages as $village)
                                            <option value="{{ $village->id }}"
                                                @if ($isEdit) {{ $village->id == $data->village_id ? 'selected' : '' }} @endif>
                                                {{ $village->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mt-lg-4 mt-3">
                        <div class="col-12 text-lg-end text-md-end text-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-regular
                                fa-circle-check"></i>
                                <span class="ms-1">{{ $isEdit ? 'Update' : 'Save' }}</span>
                            </button>
                            <a href="{{ route('pengurus-partai.index') }}" class="btn btn-warning">
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
            url="{{ route('pengurus-partai.destroy', ['pengurus_partai' => $data->id]) }}" method="DELETE" />
    @endif
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select[name="province_id"]').on('change', function() {
                let provinsiID = $(this).val();

                if (provinsiID) {
                    jQuery.ajax({
                        url: "{{ url('api/get-regency') }}?province_id=" + provinsiID,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="regency_id"]').empty();

                            $('select[name="regency_id"]').append(
                                '<option value="">CHOOSE KOTA/KABUPATEN</option>'
                            );

                            $.each(response.data, function(key, value) {
                                $('select[name="regency_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name +
                                    '</option>');
                            });

                        },
                    });
                } else {
                    $('select[name="regency_id"]').append(
                        '<option value="">CHOOSE KOTA/KABUPATEN</option>'
                    );
                }
            });

            $('select[name="regency_id"]').on('change', function() {
                let regencyID = $(this).val();

                if (regencyID) {
                    jQuery.ajax({
                        url: "{{ url('api/get-district') }}?regency_id=" + regencyID,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="district_id"]').empty();

                            $('select[name="district_id"]').append(
                                '<option value="">CHOOSE KECAMATAN</option>'
                            );

                            $.each(response.data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name +
                                    '</option>');
                            });

                        },
                    });
                } else {
                    $('select[name="district_id"]').append(
                        '<option value="">CHOOSE KECAMATAN</option>'
                    );
                }
            });

            $('select[name="district_id"]').on('change', function() {
                let districtID = $(this).val();

                if (districtID) {
                    jQuery.ajax({
                        url: "{{ url('api/get-village') }}?district_id=" + districtID,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="village_id"]').empty();

                            $('select[name="village_id"]').append(
                                '<option value="">CHOOSE KE</option>'
                            );

                            $.each(response.data, function(key, value) {
                                $('select[name="village_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name +
                                    '</option>');
                            });

                        },
                    });
                } else {
                    $('select[name="village_id"]').append(
                        '<option value="">CHOOSE KE</option>'
                    );
                }
            });
        })
    </script>
@endsection
