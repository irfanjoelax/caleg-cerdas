@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-lg-4 mb-3">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">Home</h2>
                    <h6 class="m-0 text-muted fw-semibold">
                        Welcome to {{ env('APP_NAME') }} and You are logged in as
                        <strong>{{ Str::upper(Auth::user()->role) }}
                        </strong>
                    </h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-4 col-6 mb-3">
                <x-widget-panel color="primary" title="Rukun Tetangga" count="{{ $totalRukunTetangga }}"
                    icon='<i class="fa-solid fa-house-signal"></i>' />
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-3">
                <x-widget-panel color="warning" title="Total TPS" count="{{ $totalTPS }}"
                    icon='<i class="fa-solid fa-person-booth"></i>' />
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-3">
                <x-widget-panel color="success" title="Relawan" count="{{ $totalRelawan }}"
                    icon='<i class="fa-solid fa-people-arrows"></i>' />
            </div>
            <div class="col-md-3 col-sm-4 col-6 mb-3">
                <x-widget-panel color="danger" title="Total DPT" count="{{ $totalDPT }}"
                    icon='<i class="fa-solid fa-id-badge"></i>' />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <div class="bg-white shadow p-4 rounded-4">
                    <h6 class="mb-2">Relawan by Jenis Kelamin</h6>
                    <hr>
                    <div class="">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-success m-0">Pria</p>
                            <p class="text-danger m-0">Wanita</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-success py-1 rounded-0 text-white text-center"
                                style="width: {{ $totalRelawanPRIA }}%">
                                {{ $totalRelawanPRIA }}%
                            </div>
                            <div class="bg-danger py-1 rounded-0 text-white text-center"
                                style="width: {{ $totalRelawanWANITA }}%">
                                {{ $totalRelawanWANITA }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <div class="bg-white shadow p-4 rounded-4">
                    <h6 class="mb-2">Pendukung by Jenis Kelamin</h6>
                    <hr>
                    <div class="">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-success m-0">Pria</p>
                            <p class="text-danger m-0">Wanita</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="bg-success py-1 rounded-0 text-white text-center"
                                style="width: {{ $totalRelawanPRIA }}%">
                                {{ $totalRelawanPRIA }}%
                            </div>
                            <div class="bg-danger py-1 rounded-0 text-white text-center"
                                style="width: {{ $totalRelawanWANITA }}%">
                                {{ $totalRelawanWANITA }}%
                            </div>
                        </div>
                    </div>
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
    </div>
@endsection

@section('script')
    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}
@endsection
