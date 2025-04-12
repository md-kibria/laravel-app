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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Author
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('excerpt')->nullable(); // Short description
            $table->json('content'); // Blog body
            $table->string('thumbnail')->nullable(); // Main image
            $table->enum('status', ['published', 'draft'])->default('published'); // draft, published, archived
            $table->string('views')->default(0); // View count
            $table->text('seo_keywords')->nullable();
            $table->string('comments_count')->default(0); // Comment count
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
