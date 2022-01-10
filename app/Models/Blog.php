<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    public $fillable = [
        'title','user_recruitment_id','image','deadline','detail','slug','salary_min','salary_max'
        ,'working_time','quantity','position','exp','gender','enable','cate_id','location_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function userRecruitment()
    {
        return $this->belongsTo(UserRecruitment::class, 'user_recruitment_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function apply(){
        return $this->hasMany(Apply::class, 'blog_id');
    }
}
