@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Data TPS</h2>
                    <h6 class="m-0 text-muted fw-semibold">Daftar Lengkap</h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4 mb-3 d-flex gap-3">
                    <x-form-search-table url="{{ route('voting-place.index') }}" request="{{ $request['keyword'] ?? '' }}" />

                    @if (Auth::user()->role == 'kelurahan')
                        <a href="{{ route('voting-place.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    @endif
                </div>

                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="8%">#</th>
                            <th class="text-start" width="65%">Nama</th>
                            <th class="text-end" width="20%">Total DPT</th>

                            @if (Auth::user()->role == 'kelurahan')
                                <th class="text-center" width="7%">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($places as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($places->currentPage() - 1) * $places->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    <h5 class="mb-0">{{ $item->name }}</h5>
                                    <small class="text-muted">{{ $item->neighbourhood->name }}</small> |
                                    <small class="text-muted">{{ $item->neighbourhood->village->name }}</small> |
                                    <small class="text-muted">{{ $item->neighbourhood->village->district->name }}</small> |
                                    <small
                                        class="text-muted">{{ $item->neighbourhood->village->district->regency->name }}</small>

                                </td>
                                <td class="text-end">
                                    {{ number_format($item->total_dpt) }}
                                </td>

                                @if (Auth::user()->role == 'kelurahan')
                                    <td class="text-center">
                                        <a href="{{ route('voting-place.edit', ['voting_place' => $item->id]) }}"
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
                    {{ $places->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
