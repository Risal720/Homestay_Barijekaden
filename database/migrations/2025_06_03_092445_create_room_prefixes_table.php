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
        Schema::create('room_prefixes', function (Blueprint $table) {
            $table->id();
            $table->string('prefix')->unique();
            $table->integer('max_limit')->default(999); // Max number of codes for this prefix
            $table->integer('next_number')->default(1); // Next available number for this prefix
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_prefixes');
    }
};