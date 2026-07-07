<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->string('id', 64)->primary();
            $table->string('title', 190);
            $table->string('country', 120)->default('');
            $table->string('price', 50)->default('');
            $table->string('rating', 20)->default('5.0');
            $table->string('days', 50)->default('');
            $table->text('image');
            $table->text('description')->nullable();
            $table->string('category', 60)->default('city')->index();
            $table->timestamps();
            $table->index('country');
        });

        Schema::create('package_features', function (Blueprint $table) {
            $table->id();
            $table->string('package_id', 64)->index();
            $table->string('feature', 190);
            $table->unsignedInteger('sort_order')->default(0);
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_features');
        Schema::dropIfExists('packages');
    }
};
