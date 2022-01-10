<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    use HasFactory;

    protected $table = 'user_admin';

    public $fillable = [
        "id", "name", "avatar", "phone_number"
    ];

    public function getRole()
    {
        return $this->hasMany(User::class, 'id');
    }
}
