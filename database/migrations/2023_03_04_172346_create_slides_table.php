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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('color_title')->nullable()->default('#F97316');
            $table->string('subtitle');
            $table->string('color_subtitle')->nullable()->default('#F97316');
            $table->string('image')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
