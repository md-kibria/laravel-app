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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('top-text')->nullable();
            $table->string('main-text');
            $table->string('bottom-text')->nullable();;
            $table->string('button-text');
            $table->string('button-color')->nullable();;
            $table->string('button-link');
            $table->string('bg-image')->nullable();;
            $table->string('main-image');
            $table->enum('align', ['right', 'left'])->default('left');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
