<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
   
    protected $table ="blogs";
    protected $fillable = [
        'id',
        'users_id',
        'is_publish',
        'title',
        'blog',
        'slug',
        'blog_date',
        'blog_image',  
    ];
}
