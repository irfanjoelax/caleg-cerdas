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
                    <h2 class="m-0 fw-bold">Pendukung</h2>
                    <h6 class="m-0 text-muted fw-semibold">Daftar Lengkap</h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4 mb-3 d-flex gap-3">
                    <x-form-search-table url="{{ route('pendukung.index') }}" request="{{ $request['keyword'] ?? '' }}" />

                    {{-- <a href="{{ route('pendukung.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                    </a> --}}
                </div>

                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="8%">#</th>
                            <th class="text-start" width="35%">Nama</th>
                            <th class="text-center" width="10%">RT</th>
                            <th class="text-center" width="12%">Kelamin</th>
                            <th class="text-center" width="7%">Usia (Tahun)</th>
                            <th class="text-center" width="10%">KTP</th>
                            <th class="text-center" width="18%">Kontak</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            function badge_kelamin($value)
                            {
                                if ($value == 'PRIA') {
                                    return 'info';
                                }
                            
                                if ($value == 'WANITA') {
                                    return 'danger';
                                }
                            }
                            
                            function numberWA($number)
                            {
                                return 'https://wa.me/+62' . Str::substr($number, 1, 11);
                            }
                        @endphp
                        @forelse ($pendukungs as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($pendukungs->currentPage() - 1) * $pendukungs->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-start">
                                    <h6 class="m-0">{{ $item->name }}</h6>
                                </td>
                                <td class="text-center">
                                    <h6 class="m-0">{{ $item->neighbourhood->name }}</h6>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ badge_kelamin($item->kelamin) }}">
                                        {{ $item->kelamin }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <h6 class="m-0">{{ $item->usia }}</h6>
                                </td>
                                <td class="text-center">
                                    <a data-fancybox href="{{ asset('storage/' . $item->ktp) }}"
                                        class="badge text-decoration-none text-bg-dark">
                                        Lihat
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ numberWA($item->phone) }}" target="_blank"
                                        class="badge bg-success text-decoration-none text-white">
                                        {{ $item->phone }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center py-2" colspan="7">
                                    Data Tidak Ditemukan atau Masih Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-2">
                    {{ $pendukungs->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
