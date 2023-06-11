<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Define an inverse one-to-many relationship.
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     * Define a one-to-many relationship.
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
