<?php

namespace App\Http\Controllers;

use App\Models\UserToken;
use App\Http\Requests\StoreUserTokenRequest;
use App\Http\Requests\UpdateUserTokenRequest;

class UserTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showresponses()
    {
        $questions = UserToken::with('responses:id,response_text,question_id', 'questions:')
                                ->get();
        return response()->json(['status'=>'done', 'result'=>$questions ],200) ;
    }
}
