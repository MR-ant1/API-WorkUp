<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
                'task_name' => $this->faker->word(),
                'task_description' => $this->faker->sentence(),
                'deadline_date' => $this->faker->dateTimeBetween('now', '+3 weeks')->format('Y-m-d'),
                'user_id' => DB::table('users')->inRandomOrder()->first()->id,
                'project_id' => DB::table('projects')->inRandomOrder()->first()->id,
                'manager_id' => DB::table('users')->inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}