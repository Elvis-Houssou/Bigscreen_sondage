<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'response_text',
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
}
