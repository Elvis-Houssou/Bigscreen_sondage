<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $surveyId, $userId, $questionId)
    {
        try {
            $validator = Validator::make($request->all(), [
                'response_text' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $survey = Survey::find($surveyId);
            $user = User::find($userId);
            $question = Question::find($questionId);
            // dd($survey);

            // Créer une nouvelle réponse en utilisant les valeurs validées
            $response = new Response;
            $response->survey()->associate($survey);
            $response->user()->associate($user);
            $response->question()->associate($question);
            $response->response_text = $request->input('response_text');

            // Enregistrer la réponse dans la base de données
            $response->save();
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return response()->json(['error'=>$error , 'status'=>'failed'],202);
            //throw $th;
        }
        return response()->json(['error'=>'' ,'message'=>"la paire à ete enregistrées", 'status'=>'done'],200) ;

    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResponseRequest $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
