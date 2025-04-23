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
        Schema::create('homepage_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section')->unique()->nullable(); // e.g., 'banner', 'why_choose_us'
            $table->text('sub_title')->nullable();
            $table->text('title')->nullable();
            $table->enum('type', ['general', 'key_features', 'section_title', 'insta'])->default('general')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->json('data')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['show', 'hide'])->default('show')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_contents');
    }
};
