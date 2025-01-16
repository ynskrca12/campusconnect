<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('university_topics_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('topic_id')->constrained('general_topics')->onDelete('cascade');
            $table->boolean('like')->nullable(); // true = like, false = dislike
            $table->timestamps();
            
            $table->unique(['user_id', 'topic_id']); // Her kullanıcı yalnızca bir kez beğeni/dislike yapabilir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_topics_likes');
    }
};
