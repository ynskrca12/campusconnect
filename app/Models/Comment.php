<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'universite_yorum';

    protected $fillable = [
        'user_id',
        'universite_id',
        'yorum',
    ];


    // public function user(): BelongsTo{
    //     return $this->belongsTo(User::class);
    // }

    public function universite(): BelongsTo{
        return $this->belongsTo(Universite::class);
    }
}
