<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'survey_id' => 1,
                'question_number' => 1,
                'question_body' => 'Votre adresse mail ?',
                'question_type' => 'B',
            ],
            [
                'survey_id' => 1,
                'question_number' => 2,
                'question_body' => 'Votre âge ?',
                'question_type' => 'B',
            ],
            [
                'survey_id' => 1,
                'question_number' => 3,
                'question_body' => 'Votre sexe ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 4,
                'question_body' => 'Nombre de personnes dans votre foyer (adulte & enfants – répondant inclus) ?',
                'question_type' => 'C',
            ],
            [
                'survey_id' => 1,
                'question_number' => 5,
                'question_body' => 'Votre profession ?',
                'question_type' => 'B',
            ],
            [
                'survey_id' => 1,
                'question_number' => 6,
                'question_body' => 'Quelle marque de casque VR utilisez-vous ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 7,
                'question_body' => 'Sur quel magasin d’application achetez-vous des contenus VR ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 8,
                'question_body' => 'Quel casque envisagez-vous d’acheter dans un futur proche ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 9,
                'question_body' => 'Au sein de votre foyer, combien de personnes utilisent votre casque VR pour regarder Bigscreen ?',
                'question_type' => 'C',
            ],
            [
                'survey_id' => 1,
                'question_number' => 10,
                'question_body' => 'Vous utilisez principalement Bigscreen pour ….. ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 11,
                'question_body' => 'Combien de points (de 1 à 5) donnez-vous à la qualité de l’image sur Bigscreen ?',
                'question_type' => 'C',
            ],
            [
                'survey_id' => 1,
                'question_number' => 12,
                'question_body' => 'Combien de points (de 1 à 5) donnez-vous au confort d’utilisation de l’interface Bigscreen ?',
                'question_type' => 'C',
            ],
            [
                'survey_id' => 1,
                'question_number' => 13,
                'question_body' => 'Combien de points (de 1 à 5) donnez-vous à la connexion réseau de Bigscreen ?',
                'question_type' => 'C',
            ],
            [
                'survey_id' => 1,
                'question_number' => 14,
                'question_body' => 'Combien de points (de 1 à 5) donnez-vous à la qualité des graphismes 3D dans Bigscreen ?',
                'question_type' => 'C',
            ],
            [
                'survey_id' => 1,
                'question_number' => 15,
                'question_body' => 'Combien de points (de 1 à 5) donnez-vous à la qualité audio dans Bigscreen ?',
                'question_type' => 'C',
            ],
            [
                'survey_id' => 1,
                'question_number' => 16,
                'question_body' => 'Aimeriez-vous avoir des notifications plus précises au cours de vos sessions Bigscreen ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 17,
                'question_body' => 'Aimeriez-vous pouvoir inviter un ami à rejoindre votre session via son smartphone ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 18,
                'question_body' => 'Aimeriez-vous pouvoir enregistrer des émissions TV pour pouvoir les regarder ultérieurement ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 19,
                'question_body' => 'Aimeriez-vous jouer à des jeux exclusifs sur votre Bigscreen ?',
                'question_type' => 'A',
            ],
            [
                'survey_id' => 1,
                'question_number' => 20,
                'question_body' => 'Selon vous, quelle nouvelle fonctionnalité devrait exister sur Bigscreen ?',
                'question_type' => 'B',
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
