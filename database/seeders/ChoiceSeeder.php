<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChoiceSeeder extends Seeder
{
    /**
     * Exécute le remplissage initial de la base de données.
     */
    public function run(): void
    {
        // Tableau contenant les questions et leurs choix associés.
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
                    'regarder des films',
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
        ];

        // Parcourir le tableau de questions et choix pour les enregistrer dans la base de données.
        foreach ($questions as $data) {
            // Rechercher la question par son ID.
            $question = Question::find($data['question_id']);

            // Vérifier si la question a été trouvée.
            if ($question) {
                // Parcourir les choix et les ajouter à la question.
                foreach ($data['choices'] as $choiceText) {
                    // Créer un nouvel enregistrement de choix pour la question.
                    $question->choices()->create([
                        'choice_text' => $choiceText,
                    ]);
                }
            }
        }
    }
}
