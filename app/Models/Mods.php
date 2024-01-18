<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mods extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        '_token',
        'is_visible',
    ];
    // App\Models\Mods.php

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorite_mods', 'mod_id', 'user_id')->withTimestamps();
    }

    public function user()
    {
        // A post belongs to a single user
        return $this->belongsTo(User::class, 'user_id');
    }

}
