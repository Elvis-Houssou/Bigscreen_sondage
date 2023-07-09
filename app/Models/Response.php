<?php

namespace App\Models;

use App\Models\UserToken;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'response_text', 'user_token_id','survey_id','question_id'
    ];

    /**
     * Define an inverse one-to-many relationship.
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     * Define an inverse one-to-many relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define an inverse one-to-many relationship.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Define an inverse one-to-many relationship.
     */
    public function userToken()
    {
        return $this->belongsTo(UserToken::class, 'user_token_id');
    }
}
