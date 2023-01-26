@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Rukun Tetangga</h2>
                    <h6 class="m-0 text-muted fw-semibold">Daftar Lengkap</h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4 mb-3 d-flex gap-3">
                    <x-form-search-table url="{{ route('neighbourhood.index') }}" request="{{ $request['keyword'] ?? '' }}" />

                    @if (Auth::user()->role == 'kelurahan')
                        <a href="{{ route('neighbourhood.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    @endif
                </div>

                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="8%">#</th>
                            <th class="text-start" width="50%">Nama</th>

                            @if (Auth::user()->role == 'kelurahan')
                                <th class="text-center" width="7%">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($neighbourhoods as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($neighbourhoods->currentPage() - 1) * $neighbourhoods->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    {{ $item->name }}
                                </td>

                                @if (Auth::user()->role == 'kelurahan')
                                    <td class="text-center">
                                        <a href="{{ route('neighbourhood.edit', ['neighbourhood' => $item->id]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                @endif
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
                    {{ $neighbourhoods->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
