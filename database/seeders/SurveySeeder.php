<?php

namespace Database\Seeders;

use App\Models\Survey;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Générer quelques enquêtes de test
        for ($i = 0; $i < 1; $i++) {
            Survey::create([
                'title' => $faker->sentence,
            ]);
        }
    }
}
