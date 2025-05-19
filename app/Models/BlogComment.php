<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $table = 'blog_comment';

    protected $fillable = [
        'blog_id',
        'user_id',
        'blog_comment',
        'parent_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
