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
            <div class="col-md-6 col-sm-6 col-12 mb-3">
                <x-card-district />
            </div>

            <div class="col-md-6 col-sm-6 col-12 mb-3">
                <x-card-village />
            </div>

            <div class="col-md-4 col-sm-6 col-12 mb-3">
                <x-card-neighbourhood />
            </div>

            <div class="col-md-4 col-sm-6 col-12 mb-3">
                <x-card-voting-place />
            </div>

            <div class="col-md-4 col-sm-4 col-12 mb-3">
                <x-card-relawan />
            </div>

            <div class="col-md-6 col-sm-8 col-12 mb-3">
                <x-card-voter />
            </div>

            <div class="col-md-6 col-sm-8 col-12 mb-3">
                <x-card-pendukung />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <x-card-kelamin-relawan />
            </div>
            <div class="col-md-6 col-12 mb-3">
                <x-card-kelamin-pendukung />
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
