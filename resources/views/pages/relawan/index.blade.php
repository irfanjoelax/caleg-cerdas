@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        Fancybox.bind("[data-fancybox]");
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Relawan</h2>
                    <h6 class="m-0 text-muted fw-semibold">Daftar Lengkap</h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4 mb-3 d-flex gap-3">
                    <x-form-search-table url="{{ route('relawan.index') }}" request="{{ $request['keyword'] ?? '' }}" />


                    @if (Auth::user()->role == 'kelurahan')
                        <a href="{{ route('relawan.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    @endif
                </div>

                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="8%">#</th>
                            <th class="text-start" width="40%">Nama</th>
                            <th class="text-center" width="15%">Kelamin</th>
                            <th class="text-center" width="10%">Rekrut (Pendukung)</th>
                            <th class="text-center" width="20%">Kontak</th>

                            @if (Auth::user()->role == 'kelurahan')
                                <th class="text-center" width="7%">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            function badge_kelamin($value)
                            {
                                if ($value == 'PRIA') {
                                    return 'success';
                                }
                            
                                if ($value == 'WANITA') {
                                    return 'danger';
                                }
                            }
                        @endphp
                        @forelse ($users as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    <img data-fancybox
                                        src="{{ $item->relawan->photo == 'img/avatar.svg' ? asset('img/avatar.svg') : asset('storage/' . $item->relawan->photo) }}"
                                        width="50" class="rounded-circle" loading="lazy" style="cursor: pointer">
                                    <h6 class="mt-2">{{ $item->name }}</h6>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ badge_kelamin($item->relawan->kelamin) }}">
                                        {{ $item->relawan->kelamin }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ $item->relawan->pendukungs->count() }}
                                </td>
                                <td class="text-center">
                                    {{ $item->relawan->phone }}
                                </td>

                                @if (Auth::user()->role == 'kelurahan')
                                    <td class="text-center">
                                        <a href="{{ route('relawan.edit', ['relawan' => $item->id]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
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
                    {{ $users->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
