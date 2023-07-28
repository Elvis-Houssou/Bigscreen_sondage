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
        // Utilise le générateur de données Faker pour créer des données aléatoires
        $faker = Faker::create();

        // Générer quelques enquêtes de test
        for ($i = 0; $i < 1; $i++) {
            // Créer une nouvelle enquête avec un titre aléatoire généré par Faker.
            Survey::create([
                'title' => $faker->sentence,
            ]);
        }
    }
}
