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
        Schema::create('question_years', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();

            $table->foreign('year_id')->references('id')->on('years');
            $table->foreign('question_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_years');
    }
};
