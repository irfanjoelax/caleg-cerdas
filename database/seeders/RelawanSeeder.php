<?php

namespace Database\Seeders;

use App\Models\Relawan;
use App\Models\User;
use Illuminate\Database\Seeder;

class RelawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = User::factory()->create();

            Relawan::factory()
                ->count(1)
                ->for($user)
                ->create();
        }
    }
}
