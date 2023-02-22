@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Caleg</h2>
                    <h6 class="m-0 text-muted fw-semibold">Daftar Lengkap</h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4 mb-3 d-flex gap-3">
                    <x-form-search-table url="{{ route('caleg.index') }}" request="{{ $request['keyword'] ?? '' }}" />

                    <a href="{{ route('caleg.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </div>

                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="7%">#</th>
                            <th class="text-start" width="70%">Nama</th>
                            <th class="text-center" width="15%">Urutan</th>
                            <th class="text-center" width="8%"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($caleg as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($caleg->currentPage() - 1) * $caleg->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    {{ $item->name }}
                                </td>
                                <td class="text-center">
                                    {{ $item->urutan }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('caleg.edit', ['caleg' => $item->id]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
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
                    {{ $caleg->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
