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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Page title
            $table->string('slug')->unique()->nullable();
            $table->text('content')->nullable(); // Page content
            $table->string('meta_title')->nullable(); // SEO meta title
            $table->string('meta_description')->nullable(); // SEO meta description
            $table->string('meta_keywords')->nullable(); // SEO meta keywords
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
