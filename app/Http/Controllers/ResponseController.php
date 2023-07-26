<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function userResponse($token)
    {
        $userToken = UserToken::where('token', $token)->first();

        if ($userToken) {
            // Récupérer les réponses associées au jeton
            $responses = Response::where('user_token_id', $userToken->id)->with('question:id,question_body')->get();
            return response()->json(['status' => 'done', 'result' => $responses], 200);
        }

        return response()->json(['status' => 'failed', 'error' => 'token inexistant'], 202);

    }

    public function responseStore(Request $request )
    {
        try {
            $responses = $request->input('responses');
            $rules = [
                'responses.*.response_text' => 'required',
                'responses.*.question_id' => 'required|exists:questions,id',
                'responses.*.survey_id' => 'required|exists:surveys,id',
            ];

            // Valider les réponses
            $validator = Validator::make(['responses' => $responses], $rules);

            // Vérifie si la validation a échoué
            if ($validator->fails()) {
                return response()->json(['status' => 'failed', 'error' => $validator->errors()], 400);
            }

            $createToken = Str::uuid()->toString();

            $token = new UserToken();
            $token->token = $createToken;
            $token->save();

            // Parcourir les réponses et les formater pour l'insertion
            foreach ($responses as $response) {
                Response::create([
                    'response_text' => $response['response_text'],
                    'question_id' => $response['question_id'],
                    'survey_id' => $response['survey_id'],
                    'user_token_id' => $token->id,
                ]);
            }


            return response()->json(['status' => 'done' ,"message" => "Les réponses ont bien été enregistré" , "token" => $createToken], 200);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return response()->json(['status' => 'failed', 'error' => $error], 202);
        }

        // Si aucune réponse n'a été fournie

    }
}
