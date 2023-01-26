@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Kecamatan</h2>
                    <h6 class="m-0 text-muted fw-semibold">Daftar Lengkap</h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4 mb-3 d-flex gap-3">
                    <x-form-search-table url="{{ route('district.index') }}" request="{{ $request['keyword'] ?? '' }}" />

                    {{-- <a href="{{ route('district.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                    </a> --}}
                </div>

                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="8%">#</th>
                            <th class="text-start" width="92%">Nama</th>
                            {{-- <th class="text-center" width="7%">Aksi</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($districts as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($districts->currentPage() - 1) * $districts->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    {{ $item->name }}
                                </td>
                                {{-- <td class="text-center">
                                    <a href="{{ route('district.edit', ['district' => $item->id]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center py-2" colspan="6">
                                    Data Tidak Ditemukan atau Masih Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-2">
                    {{ $districts->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
