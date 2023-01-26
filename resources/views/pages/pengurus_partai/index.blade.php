@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Pengurus Partai</h2>
                    <h6 class="m-0 text-muted fw-semibold">Daftar Lengkap</h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4 mb-3 d-flex gap-3">
                    <x-form-search-table url="{{ route('pengurus-partai.index') }}"
                        request="{{ $request['keyword'] ?? '' }}" />

                    <a href="{{ route('pengurus-partai.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>

                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="6%">#</th>
                            <th class="text-start" width="47%">Nama</th>
                            <th class="text-start" width="42%">Ketua Partai</th>
                            <th class="text-center" width="5%"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pengurus as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($pengurus->currentPage() - 1) * $pengurus->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    {{ $item->name }}
                                </td>
                                <td class="text-start">
                                    {{ $item->ketua_partai }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pengurus-partai.edit', ['pengurus_partai' => $item->id]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
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
                    {{ $pengurus->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
