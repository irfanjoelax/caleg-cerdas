@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-2">
                    <h2 class="m-0 fw-bold">{{ Str::title($regency->name) }}</h2>
                    <h6 class="m-0 text-muted fw-semibold">Detail Data</h6>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6 col-12 mb-3">
                <div class=" bg-white p-3 rounded-4 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Kecamatan</td>
                                <td class="text-end">
                                    {{ number_format($totalDistrict) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Kelurahan</td>
                                <td class="text-end">
                                    {{ number_format($totalVillage) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Rukun Tetangga (RT)</td>
                                <td class="text-end">
                                    {{ number_format($totalNeighbourhood) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tempat Pemungutan Suara (TPS)</td>
                                <td class="text-end">
                                    {{ number_format($totalTPS) }}
                                </td>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <div class=" bg-white p-3 rounded-4 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Relawan</td>
                                <td class="text-end">
                                    {{ number_format($totalRelawan) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Daftar Pemilih Tetap (DPT)</td>
                                <td class="text-end">
                                    {{ number_format($totalDPT) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Pendukung</td>
                                <td class="text-end">
                                    {{ number_format($totalPendukung) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Target Suara</td>
                                <td class="text-end">
                                    {{ number_format($totalTargetSuara) }}
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
