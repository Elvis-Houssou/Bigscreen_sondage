<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reponses générer aléatoirement

        // $faker = Faker::create();
        // $surveys = Survey::all();
        // $users = User::all();
        // $questions = Question::all();

            // Générer quelques réponses de test pour chaque utilisateur, enquête et question
        // foreach ($surveys as $survey) {
        //     foreach ($users as $user) {
        //         foreach ($questions as $question) {
        //             Response::create([
        //                 'survey_id' => $survey->id,
        //                 'user_id' => $user->id,
        //                 'question_id' => $question->id,
        //                 'response_text' => $faker->sentence,
        //             ]);
        //         }
        //     }
        // }
    }
}
