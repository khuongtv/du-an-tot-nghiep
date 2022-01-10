<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyDetail extends Model
{
    use HasFactory;

    protected $table = 'apply_detail';

    protected $fillable = [
        'name',
        'apply_id'
    ];

    public function apply()
    {
        return $this->belongsTo(Apply::class, 'apply_id');
    }
}
