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
        Schema::create('taboos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('reason')->nullable();
            $table->text('consequence')->nullable();
            $table->string('applies_to')->nullable(); // e.g. men, women, children
            $table->foreignId('clan_id')->nullable()->constrained()->onDelete('set null');
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taboos');
    }
};
