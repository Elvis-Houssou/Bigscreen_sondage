<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = ['choice_text'];

    /**
     * Define an inverse one-to-many relationship.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
