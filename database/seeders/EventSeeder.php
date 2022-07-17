<?php

namespace Database\Seeders;

use App\Models\Events;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Events::factory()->count(200)->create();
    }
}
