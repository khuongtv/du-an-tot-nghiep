<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCandidate extends Model
{
    use HasFactory;

    protected $table = 'user_candidate';

    protected $fillable = [
        'id',
        'name',
        'avatar',
        'gender',
        'birthday',
        'education',
        'exp',
        'skill',
        'address',
        'cate_id',
        'location_id',
        'phone_number',
        'link_facebook',
        'link_linkedin',
        'intro',
        'detail'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function favorites()
    {
        return $this->hasMany(Fovorite::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
}
