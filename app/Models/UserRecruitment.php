<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRecruitment extends Model
{
    use HasFactory;

    protected $table = 'user_recruitment';

    protected $fillable = [
        'id',
        'name',
        'location_id',
        'cate_id',
        'avatar',
        'logo',
        'image',
        'banner',
        'verification',
        'company_size',
        'phone',
        'tax_code',
        'date_start',
        'intro',
        'detail',
        'address',
        'map',
        'link_website',
        'slug'
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    const ON_TICK = 1;
    const OFF_TICK = 0;

    public function userFile()
    {
        return DB::table('user_recruitment')
            ->select(
                "user_file.file as file"
            )
            ->join('user_file', 'user_recruitment.id', '=', 'user_file.user_id')
            ->get()
            ->toArray();
    }
}
