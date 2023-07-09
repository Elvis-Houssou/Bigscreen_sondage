<?php

namespace App\Models;

use App\Models\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserToken extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'token',
    ];

    /**
     * Define a one-to-many relationship.
     */
    public function responseToken()
    {
        return $this->hasMany(Response::class);
    }
}
