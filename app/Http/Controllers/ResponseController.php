<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showGraphic()
    {
        $responses = Response::with('question:id,question_body,question_type')->get();

        return response()->json(['error'=>'', 'status'=>'done', 'result'=>$responses],200) ;
    }


    /**
     * Display a listing of the resource.
     */
    public function showResponses()
    {
        $responses = Response::with('question:id,question_body')
                                ->select('user_token_id','question_id','response_text')
                                ->orderBy('question_id', 'asc')
                                ->get()
                                ->groupBy('user_token_id');

        return response()->json(['error'=>'', 'status'=>'done', 'result' => $responses], 200);
    }

    // public function userResponse(UserToken $id)
    // {

    //     $userResponses = $id->responseToken()->with('question:id,question_body,question_type')->get();

    //     return response()->json(['error' => '', 'status' => 'done', 'result' => $userResponses], 200);
    // }

    public function userResponse($token)
    {
        $userToken = UserToken::where('token', $token)->first();

        if ($userToken) {
            // Récupérer les réponses associées au jeton
            $responses = Response::where('user_token_id', $userToken->id)->with('question:id,question_body')->get();
            return response()->json(['error' => '', 'status' => 'done', 'result' => $responses], 200);
        }

        return response()->json(['error' => 'erreur', 'status' => 'done', 'result' => ''], 200);
        // $userResponses = $userToken->responseToken()->with('question:id,question_body,question_type')->get();

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                return response()->json(['error' => $validator->errors(), 'status' => 'error'], 400);
            }

            $createToken = Str::uuid()->toString();

            $token = new UserToken();
            $token->token = $createToken;
            $token->save();

            $answerCounters = [
                'Oculus Quest' => 0 ,
                'Oculus Rift/s' => 0 ,
                'HTC Vive' => 0 ,
                'Windows Mixed' => 0 ,
                'Reality' => 0 ,
                'Valve index' => 0
            ];

            // dd($responses);
            // Parcourir les réponses et les formater pour l'insertion
            foreach ($responses as $response) {
                Response::create([
                    'response_text' => $response['response_text'],
                    'question_id' => $response['question_id'],
                    'survey_id' => $response['survey_id'],
                    'user_token_id' => $token->id,
                ]);

                // Vérifier si la réponse correspond à la question 6
                if ($response['question_id'] == 6) {
                    // Incrémenter le compteur correspondant en fonction de la réponse
                    switch ($response['response_text']) {
                        case 'Oculus Quest':
                            $answerCounters['Oculus Quest']++;
                            break;
                        case 'Oculus Rift/s':
                            $answerCounters['Oculus Rift/s']++;
                            break;
                        case 'HTC Vive':
                            $answerCounters['HTC Vive']++;
                            break;
                        case 'Windows Mixed':
                            $answerCounters['Windows Mixed']++;
                            break;
                        case 'Reality':
                            $answerCounters['Reality']++;
                            break;
                        case 'Valve index':
                            $answerCounters['Valve index']++;
                            break;
                    }
                }
            }

            // dd($answerCounters);


            return response()->json(['error' => '',"message" => "Les réponses ont bien été enregistré" , "count" => $answerCounters , "token" => $createToken , 'status' => 'done'], 200);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return response()->json(['error' => $error, 'status' => 'error'], 202);
        }

        // Si aucune réponse n'a été fournie

    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }
}
