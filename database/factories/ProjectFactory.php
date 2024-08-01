<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProjectFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
                'project_title' => $this->faker->lorem->sentences(),
                'project_description' => $this->faker->paragraph(60),
                'creator_id' => DB::table('users')->inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}
