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
        Schema::create('artifacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('material')->nullable();
            $table->string('origin')->nullable();
            $table->text('use_case')->nullable();
            $table->string('image_path')->nullable();
            $table->string('category')->nullable(); // Music, Royalty, etc.
            $table->string('preservation_status')->nullable(); // e.g. Preserved
            $table->string('location')->nullable(); // e.g. Palace Museum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artifacts');
    }
};
