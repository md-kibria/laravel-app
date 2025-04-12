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
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // User who viewed
            $table->foreignId('post_id')->nullable()->constrained()->onDelete('set null'); // Post that was viewed
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null'); // Service that was viewed
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null'); // Order that was viewed
            $table->string('page_id')->nullable(); // Page that was viewed
            $table->string('ip_address')->nullable(); // IP address of the viewer
            $table->text('user_agent')->nullable(); // User agent of the viewer
            $table->string('referrer')->nullable(); // Referrer URL
            $table->enum('type', ['page', 'post', 'service'])->default('page')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
