@extends('layouts.relawan')

@section('title')
    List Pendukung
@endsection

@section('content')
    <form action="{{ route('pendukung.index') }}" class="mt-3" method="GET">
        <div class="input-group mb-3">
            <input type="search" class="form-control" name="keyword" value="{{ $request['keyword'] ?? '' }}"
                placeholder="Nama Pendukung..">
            <button class="btn btn-outline-primary" type="submit">
                <i class="bi bi-search"></i>
                Cari
            </button>
        </div>
    </form>

    <ul class="list-group rounded-4">
        @php
            function numberWA($number)
            {
                return 'https://wa.me/+62' . Str::substr($number, 1, 11);
            }
        @endphp

        @forelse ($pendukungs as $item)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <p class="m-0 fw-bold">
                    {{ ($pendukungs->currentPage() - 1) * $pendukungs->perPage() + $loop->iteration }}.
                </p>
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{ $item->name }}</div>
                    <small class="text-{{ $item->kelamin == 'PRIA' ? 'success' : 'danger' }}" style="font-size: .75rem">
                        @if ($item->kelamin == 'PRIA')
                            <i class="fa-solid fa-mars"></i>
                        @endif

                        @if ($item->kelamin == 'WANITA')
                            <i class="fa-solid fa-venus"></i>
                        @endif

                        {{ $item->kelamin }}
                    </small> -
                    <small class="text-default" style="font-size: .75rem">
                        {{ $item->usia }} TAHUN
                    </small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('pendukung.edit', ['pendukung' => $item->id]) }}"
                        class="badge bg-warning rounded-pill text-white">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ numberWA($item->phone) }}" target="_blank" class="badge bg-success rounded-pill text-white">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </li>
        @empty
            <div class="text-center py-5">
                <img src="{{ asset('img/not-found-3.svg') }}" class="img-fluid mb-4" width="175">
                <h1 class="display-6 fw-semibold">Opps..!</h1>
                <h6 class="text-muted">Daftar Data Pendukung Masih Kosong <br> Atau Tidak Ditemukan</h6>
            </div>
        @endforelse
    </ul>

    <a href="{{ route('pendukung.create') }}" class="btn btn-lg btn-primary rounded-4 shadow position-fixed"
        style="bottom: 100px; right: 15px">
        <i class="bi bi-plus-circle"></i>
    </a>
@endsection
