<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * fonction de connexion de l'utilisateur
     */
    public function login(Request $request){
        try {
            // Valide les champs d'entrée 'email' et 'password' du formulaire.
            $request->validate([
                "email"=>"required|email:rfc",
                "password"=>"required|string",
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
                return response()->json([ 'status'=>'failed', 'error'=>$error],202);
        }

        $user = User::where(['email'=>$request->email])->first();

        // Vérifie si l'utilisateur existe dans la base de données en fonction de l'e-mail fourni.
        if (!$user) {
           return response()->json(['status'=>'failed', 'error'=>'impossible de se connecter '],202);
        }

        // Vérifie si le mot de passe fourni correspond au mot de passe haché stocké dans la base de données.
        if (!Hash::check($request->password,$user->password) ) {
           return response()->json(['status'=>'failed', 'error'=>'mot de passe incorrect '],202);

        }

        // Génère un jeton d'accès pour l'utilisateur et le retourne avec les informations de l'utilisateur connecté.
        $userToken = $user->createToken( "token",  ['*'], now()->addMinutes(15))->plainTextToken;
        return response()->json(['status'=>'done', "Message"=>"connexion valider", "result" => $user ,"token"=>$userToken],200);

    }

    /**
     * Affiche la liste de toutes les réponses pour la génération du graphique.
     */
    public function showGraphic()
    {
        $responses = Response::all();

        return response()->json([ 'status'=>'done', 'result'=>$responses],200) ;
    }

    /**
     * Affiche la liste de toutes les questions avec leurs choix associés.
     */
    public function questionsList()
    {
        $questions = Question::with('choices:id,choice_text,question_id')
                            ->select('id','question_number','question_body','question_type','survey_id')
                            ->get();
        return response()->json(['status'=>'done', 'result'=>$questions],200) ;

    }

    /**
     * Affiche la liste des réponses groupées par jeton d'utilisateur.
     */
    public function surveyedResponses()
    {
        $responses = Response::with('question:id,question_body')
                                ->select('user_token_id','question_id','response_text')
                                ->orderBy('question_id', 'asc')
                                ->get()
                                ->groupBy('user_token_id');

        return response()->json(['status'=>'done', 'result' => $responses], 200);
    }
}
