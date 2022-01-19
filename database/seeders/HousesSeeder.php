<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        House::factory()->times(50)->create();
    }
}
