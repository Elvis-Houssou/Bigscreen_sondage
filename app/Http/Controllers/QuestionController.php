<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * récuperer toutes les questions avec leurs choix associés
     */
    public function showQuestions()
    {
        $questions = Question::with('choices:id,choice_text,question_id')
                            ->select('id','question_number','question_body','question_type','survey_id')
                            ->get();
        // Retourner les résultats sous forme de réponse JSON
        return response()->json(['status'=>'done', 'error'=>'', 'result'=>$questions ],200) ;

    }
}
