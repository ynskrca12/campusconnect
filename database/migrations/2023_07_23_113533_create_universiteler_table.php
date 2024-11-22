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
        Schema::create('universiteler', function (Blueprint $table) {
            $table->id();
            $table->string('universite_ad');
            $table->string('kurulus');
            $table->string('universite_il');
            $table->string('turu');
            $table->string('internet_sitesi');
            $table->longText('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universiteler');
    }
};
