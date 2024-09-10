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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('c_title');
            $table->string('c_slug');
            $table->text('c_description')->nullable();
            $table->text('c_colour')->nullable();
            $table->string('c_image')->nullable();
            $table->string('c_seo_title')->nullable();
            $table->string('c_seo_image')->nullable();
            $table->string('c_seo_description')->nullable();
            $table->text('c_keyword')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
