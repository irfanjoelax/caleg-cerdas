<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // USER ADMIN
        User::create([
            'name'     => 'Admin Utama',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role'     => 'admin'
        ]);

        // USER PROVINSI => UNTUK KALIMANTAN TIMUR
        User::create([
            'name'        => 'Admin Provinsi',
            'email'       => 'provinsi@admin.com',
            'password'    => bcrypt('123456'),
            'role'        => 'provinsi',
            'province_id' => env('PROVINSI_ID')
        ]);

        // USER KOTA/KABUPATEN => UNTUK SAMARINDA
        User::create([
            'name'        => 'Admin Kota Samarinda',
            'email'       => 'kota@admin.com',
            'password'    => bcrypt('123456'),
            'role'        => 'kota',
            'province_id' => env('PROVINSI_ID'),
            'regency_id'  => 6472,
        ]);

        // USER KECAMATAN => UNTUK SUNGAI KUNJANG
        User::create([
            'name'        => 'Admin Sungai Kunjang',
            'email'       => 'kecamatan@admin.com',
            'password'    => bcrypt('123456'),
            'role'        => 'kecamatan',
            'province_id' => env('PROVINSI_ID'),
            'regency_id'  => 6472,
            'district_id' => 6472040,
        ]);

        // USER KELURAHAN => UNTUK KARANG ASAM ILIR
        User::create([
            'name'        => 'Admin Karang Asam Ilir',
            'email'       => 'kelurahan@admin.com',
            'password'    => bcrypt('123456'),
            'role'        => 'kelurahan',
            'province_id' => env('PROVINSI_ID'),
            'regency_id'  => 6472,
            'district_id' => 6472040,
            'village_id'  => 6472040006,
        ]);
    }
}
