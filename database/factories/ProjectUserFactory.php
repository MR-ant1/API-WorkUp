<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProjectUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
                'proyect_id' => DB::table('projects')->inRandomOrder()->first()->id,
                'user_id' => DB::table('users')->inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}
