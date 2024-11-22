<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class GeneralTopic extends Model
{
    use HasFactory;

    protected $table = 'general_topics';


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }//End



}
