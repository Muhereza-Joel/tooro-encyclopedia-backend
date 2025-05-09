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
        Schema::create('petty_names', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('gender'); // e.g. 'male', 'female', 'both'
            $table->text('meaning');
            $table->string('origin')->nullable();
            $table->text('description')->nullable();
            $table->string('common_in_clans')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petty_names');
    }
};
