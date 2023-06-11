<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    /**
     * Define a one-to-many relationship.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Define a one-to-many relationship.
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
