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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('registration')->nullable();
            $table->text('vat')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('postalCode')->nullable();

            $table->string('url')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            
            $table->text('google_key')->nullable();
            $table->text('stripe_key')->nullable();
            $table->text('netopia_key')->nullable();
            $table->text('netopia_signature')->nullable();

            $table->text('copyright')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_symbol')->nullable();

            $table->string('subs_sub_title')->nullable();
            $table->string('subs_title')->nullable();
            $table->text('subs_desc')->nullable();
            $table->string('subs_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
