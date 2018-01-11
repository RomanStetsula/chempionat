<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'author',
        'main_img',
        'thumbs_img',
        'content',
        'created_at',
        'user_id'
    ];
    /**
     * @var bool
     */
   public $timestamps = false;
}
