<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question_id' => 3,
                'choices' => [
                    'Homme',
                    'Femme',
                    'Préfère ne pas répondre',
                ],
            ],
            [
                'question_id' => 6,
                'choices' => [
                    'Oculus Quest',
                    'Oculus Rift/s',
                    'HTC Vive',
                    'Windows Mixed Reality',
                    'Valve Index',
                ],
            ],
            [
                'question_id' => 7,
                'choices' => [
                    'SteamVR',
                    'Oculus Store',
                    'Viveport',
                    'Windows Store',
                ],
            ],
            [
                'question_id' => 8,
                'choices' => [
                    'Oculus Quest',
                    'Oculus Go',
                    'HTC Vive Pro',
                    'PSVR',
                    'Autre',
                    'Aucun',
                ],
            ],
            [
                'question_id' => 10,
                'choices' => [
                    'regarder la TV en direct',
                    'regarder des films,',
                    'travailler',
                    'jouer en solo',
                    ' jouer en équipe',
                ],
            ],
            [
                'question_id' => 16,
                'choices' => [
                    'Oui',
                    'Non',
                ],
            ],
            [
                'question_id' => 17,
                'choices' => [
                    'Oui',
                    'Non',
                ],
            ],
            [
                'question_id' => 18,
                'choices' => [
                    'Oui',
                    'Non',
                ],
            ],
            [
                'question_id' => 19,
                'choices' => [
                    'Oui',
                    'Non',
                ],
            ],
            // Ajoutez les autres questions avec leurs choix
        ];

        foreach ($questions as $data) {
            $question = Question::find($data['question_id']);

            if ($question) {
                foreach ($data['choices'] as $choiceText) {
                    $question->choices()->create([
                        'choice_text' => $choiceText,
                    ]);
                }
            }
        }
    }
}
