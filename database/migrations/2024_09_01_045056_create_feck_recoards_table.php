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
        Schema::create('feck_recoards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fack_user_id');
            $table->unsignedBigInteger('modeltest_id');
            $table->integer('correct_answers_count')->default(0);
            $table->integer('incorrect_answers_count')->default(0);
            $table->timestamps();

            $table->foreign('fack_user_id')->references('id')->on('fackusers')->onDelete('cascade');
            $table->foreign('modeltest_id')->references('id')->on('model_tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feck_recoards');
    }
};
