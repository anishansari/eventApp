<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'start_date' => date('Y-m-d'),
            'end_date' => Carbon::parse(Carbon::now()->addDays(1))->format('Y-m-d'),
            'from_time' => date('H:i'),
            'to_time' => Carbon::parse(Carbon::now()->addHour())->format('H:i'),
            'status' => 'active',
        ];
    }
}
