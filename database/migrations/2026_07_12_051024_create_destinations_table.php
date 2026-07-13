<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('country', 120);

            $table->string('thumbnail')->nullable();

            $table->text('short_description')->nullable();

            $table->longText('description')->nullable();

            $table->boolean('featured')->default(false);

            $table->boolean('status')->default(true);

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
