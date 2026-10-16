<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Campos que podem ser preenchidos em conjunto.
    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo_path',
    ];
}