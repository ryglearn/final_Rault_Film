<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    public function wishlistedBy()
{
    return $this->belongsToMany(User::class, 'wishlist')->withTimestamps();
}
}
