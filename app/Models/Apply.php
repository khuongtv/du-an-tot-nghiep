<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $table = 'apply';

    protected $fillable = [
        'user_candidate_id',
        'blog_id',
        'name_candidate',
        'phone_candidate',
        'email_candidate',
        'message',
        'file',
        'status'
    ];

    public function userCandidate()
    {
        return $this->belongsTo(UserCandidate::class, 'user_candidate_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function applyDetails()
    {
        return $this->hasMany(ApplyDetail::class);
    }
}
