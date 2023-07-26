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
    public function register(Request $request){
        try {
            $request->validate([
                'name'=>'required|string',
                'email'=>'required|email:filter',
                'password'=>'required|string',
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
                return response()->json(['status'=>'failed', 'error'=>$error],202);
                //throw $th;
        }

        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);

        return response()->json(['status'=>'done' ,"Message"=>"Utilisateur enregistré", 'result' => $user]);

    }

    public function login(Request $request){
        try {
            $request->validate([
                "email"=>"required|email:rfc",
                "password"=>"required|string",
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
                return response()->json([ 'status'=>'failed', 'error'=>$error],202);
        }

        $user = User::where(['email'=>$request->email])->first();

        if (!$user) {
           return response()->json(['status'=>'failed', 'error'=>'impossible de se connecter '],202);
        }
        if (!Hash::check($request->password,$user->password) ) {
           return response()->json(['status'=>'failed', 'error'=>'mot de passe incorrect '],202);

        }
        $userToken = $user->createToken( "token",  ['*'], now()->addMinutes(15))->plainTextToken;
        return response()->json(['status'=>'done', "Message"=>"connexion valider", "result" => $user ,"token"=>$userToken],200);

    }

    /**
     * Display a listing of the responses for the graphic.
     */
    public function showGraphic()
    {
        $responses = Response::all();

        return response()->json([ 'status'=>'done', 'result'=>$responses],200) ;
    }

    /**
     * Display a listing of the resource.
     */
    public function questionsList()
    {
        $questions = Question::with('choices:id,choice_text,question_id')
                            ->select('id','question_number','question_body','question_type','survey_id')
                            ->get();
        return response()->json(['status'=>'done', 'result'=>$questions],200) ;

    }

    /**
     * Display a listing of the resource.
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
