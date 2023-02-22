@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">{{ Str::title($village->name) }}</h2>
                    <h6 class="m-0 text-muted fw-semibold">Detail Data</h6>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 col-12 mb-3">
                <ul class="list-group rounded-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Rukun Tetangga (RT)
                        <span class="badge bg-primary rounded-pill">
                            {{ number_format($totalNeighbourhood) }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tempat Pemungutan Suara (TPS)
                        <span class="badge bg-primary rounded-pill">
                            {{ number_format($totalTPS) }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Daftar Pemilih Tetap (DPT)
                        <span class="badge bg-primary rounded-pill">
                            {{ number_format($totalDPT) }}
                        </span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <ul class="list-group rounded-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Relawan
                        <span class="badge bg-primary rounded-pill">
                            {{ number_format($totalRelawan) }}
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pendukung
                        <span class="badge bg-primary rounded-pill">
                            {{ number_format($totalPendukung) }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
