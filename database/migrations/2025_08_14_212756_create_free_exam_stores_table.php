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
        Schema::create('free_exam_stores', function (Blueprint $table) {
            $table->id();
             $table->string('user_name')->nullable();;
            $table->ipAddress('ip_address')->nullable();
            $table->ipAddress('mobile_ip')->nullable();
            $table->string('user_phone')->nullable();
            $table->unsignedBigInteger('modeltest_id')->nullable();
             $table->string('modeltest_count')->nullable();
            $table->integer('correct_answers_count')->default(0);
            $table->integer('incorrect_answers_count')->default(0);
            $table->timestamps();
            $table->foreign('modeltest_id')->references('id')->on('model_tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_exam_stores');
    }
};
