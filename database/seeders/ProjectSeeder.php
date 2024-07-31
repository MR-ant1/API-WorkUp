<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $faker = Faker::create();

        for ($i = 0; $i < 40; $i++) {
            DB::table('projects')->insert([
                'project_title' => $faker->text(30),
                'project_description' => $faker->text(60),
                'creator_id' => DB::table('users')->inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
