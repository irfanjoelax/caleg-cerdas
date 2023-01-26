<?php

namespace Database\Seeders;

use App\Models\Neighbourhood;
use App\Models\VotingPlace;
use Illuminate\Database\Seeder;

class NeighbourhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * SEBAGAI CONTOH DATA LENGKAP RT
         * ==============================
         * KELURAHAN KARANG ASAM ILIR,
         * KECAMATAN SUNGAI KUNJANG
         * KOTA SAMARINDA
         */
        for ($i = 1; $i <= 35; $i++) {
            $neighbourdhood = Neighbourhood::create([
                'name'        => "RT. " . sprintf("%03s", $i),
                'village_id'  => 6472040006,
                'district_id' => 6472040,
                'regency_id'  => 6472,
                'province_id' => env('PROVINSI_ID'),
            ]);

            VotingPlace::create([
                'name'             => 'TPS ' . $i,
                'neighbourhood_id' => $neighbourdhood->id,
                'village_id'       => 6472040006,
                'district_id'      => 6472040,
                'regency_id'       => 6472,
                'province_id'      => env('PROVINSI_ID'),
                'total_dpt'        => random_int(100, 300)
            ]);
        }
    }
}
