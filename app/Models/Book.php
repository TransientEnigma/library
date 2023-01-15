<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $guarded = [];

    public function path()
    {
        // will look something like /books/1-enders-game
        return '/books/' . $this->id;
    }
}
