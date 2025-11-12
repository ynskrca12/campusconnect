<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class University extends Model
{
    use HasFactory;

    protected $table = 'universiteler';


    // public function user(): BelongsTo{
    //     return $this->belongsTo(User::class);
    // }
    // public function comments(): HasMany{
    //     return $this->hasMany(Comment::class);
    // }

    public function topics()
    {
        return $this->hasMany(UniversityTopic::class, 'university_id');
    }

}
