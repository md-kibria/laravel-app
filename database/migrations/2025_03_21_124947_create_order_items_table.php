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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('quantity');
            $table->json('price');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->json('variations')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
