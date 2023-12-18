<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mods extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        // Add '_token' to the fillable fields
        '_token',
    ];
}
