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
        Schema::create('universities_topics', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by');
            $table->integer('user_id');
            $table->integer('university_id');
            $table->string('category');
            $table->string('topic_title');
            $table->text('topic_title_slug');
            $table->text('comment');
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities_topics');
    }
};
