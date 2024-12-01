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
        Schema::table('general_topics', function (Blueprint $table) {
            $table->string('topic_title_slug')->after('topic_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_topics', function (Blueprint $table) {
            $table->dropColumn('topic_title_slug');
        });
    }
};
