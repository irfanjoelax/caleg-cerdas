@extends('layouts.relawan')

@section('title')
    {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <div class="bg-primary rounded-4 p-4 text-white">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6>Total Pendukung</h6>
                        <h1 class="display-5 m-0">{{ number_format($totalPendukung) }}</h1>
                    </div>
                    <h1><i class="fa-solid fa-users-rays"></i></h1>
                </div>
                <hr>
                <a href="{{ route('pendukung.index') }}"
                    class="text-decoration-none text-white d-flex align-items-center justify-content-between">
                    <small>Lihat Selengkapnya</small>
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="bg-white shadow rounded-4 p-1">
                {!! $chart->renderHtml() !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="bg-white shadow p-4 rounded-4">
                <small class="m-0">Pendukung Berdasarkan Jenis Kelamin</small>
                <hr>
                <div class="">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text-success m-0">Pria</p>
                        <p class="text-danger m-0">Wanita</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-success py-1 rounded-0 text-white text-center"
                            style="width: {{ $totalPendukungPRIA }}%">
                            {{ $totalPendukungPRIA }}%
                        </div>
                        <div class="bg-danger py-1 rounded-0 text-white text-center"
                            style="width: {{ $totalPendukungWANITA }}%">
                            {{ $totalPendukungWANITA }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}
@endsection
