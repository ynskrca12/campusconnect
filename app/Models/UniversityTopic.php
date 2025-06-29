<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UniversityTopic extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'universities_topics';

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'university_id', 'id');
    }//End


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }//End

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
