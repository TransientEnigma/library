<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];

    protected $dates = ['dob'];

    // hijack and mutate the dob property
    public function setDobAttribute($dob)
    {
        // an attribute is an actual array, assign value to it.
        $this->attributes['dob'] = Carbon::parse($dob);
    }
}
