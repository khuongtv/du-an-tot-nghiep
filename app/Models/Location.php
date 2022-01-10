<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function userCandidates()
    {
        return $this->hasMany(UserCandidate::class);
    }
}
