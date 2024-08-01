<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class ProjectUserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ProjectUser::factory(10)->create();
    }
}
