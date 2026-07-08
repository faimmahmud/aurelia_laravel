<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {

            $table->id();

            $table->string('group')->index();

            $table->string('key')->unique();

            $table->longText('value')->nullable();

            $table->enum('type', [
                'text',
                'textarea',
                'html',
                'image',
                'json',
                'boolean',
                'number',
                'url',
                'email'
            ])->default('text');

            $table->boolean('autoload')->default(true);

            $table->timestamps();

            $table->index(['group','key']);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};