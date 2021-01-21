<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_name',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
