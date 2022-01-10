<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = [
        'image',
        'price', 
        'from_time', 
        'to_time', 
        'link', 
        'role', 
        'alt'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'role');
    }
}
