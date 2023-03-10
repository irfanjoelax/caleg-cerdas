<?php

namespace App\Http\Controllers;

use App\Models\Pendukung;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function index()
    {
        $totalPendukung = null;
        $conditions = null;
        $view = [];

        if (Auth::user()->role == 'provinsi') {
            $conditions = 'province_id = ' . Auth::user()->province_id;
            $view       = 'pages.home.provinsi';
        }

        if (Auth::user()->role == 'kota') {
            $conditions = 'regency_id = ' . Auth::user()->regency_id;
            $view       = 'pages.home.kota';
        }

        if (Auth::user()->role == 'kecamatan') {
            $conditions = 'district_id = ' . Auth::user()->district_id;
            $view       = 'pages.home.kecamatan';
        }

        if (Auth::user()->role == 'kelurahan') {
            $conditions = 'village_id = ' . Auth::user()->village_id;
            $view       = 'pages.home.kelurahan';
        }

        if (Auth::user()->role == 'relawan') {
            $conditions = 'relawan_id = ' . Auth::user()->relawan->id;
            $view       = 'pages.home.relawan';
            $totalPendukung = Pendukung::where('relawan_id', Auth::user()->relawan->id)->count();
        }

        if (Auth::user()->role == 'admin') {
            $conditions = 'province_id = ' . Auth::user()->province_id;
            $view       = 'pages.home';
        }

        $chart_options = [
            'chart_title'     => 'Grafik Pendukung Per Bulan',
            'report_type'     => 'group_by_date',
            'model'           => 'App\Models\Pendukung',
            'conditions'      => [
                [
                    'condition' => $conditions,
                    'color'     => '#34495e',
                    'fill'      => true
                ],
            ],
            'group_by_field'  => 'created_at',
            'group_by_period' => 'day',
            'filter_period'   => 'month',
            'chart_type'      => 'line',
        ];

        $chart = new LaravelChart($chart_options);

        return view($view, compact('chart', 'totalPendukung'));
    }
}
