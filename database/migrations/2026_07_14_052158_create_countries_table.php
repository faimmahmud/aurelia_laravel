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
        Schema::create('countries', function (Blueprint $table) {

            $table->id();

            // Basic Information
            $table->string('name');
            $table->string('slug')->unique();

            // ISO Information
            $table->string('iso2', 2)->nullable();
            $table->string('iso3', 3)->nullable();

            // Contact & Currency
            $table->string('phone_code', 10)->nullable();
            $table->string('currency', 10)->nullable();

            // Images
            $table->string('flag')->nullable();
            $table->string('hero_image')->nullable();

            // Content
            $table->text('description')->nullable();

            // Status
            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            // Laravel Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
