<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    use HasFactory;

    protected $table = 'user_file';

    protected $fillable = [
        'name',
        'file',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(Category::class, 'user_id');
    }
}
