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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('course_id');
            $table->integer('status');
            $table->text('m_description')->nullable();
            $table->text('video_link')->nullable();
            $table->text('pdf_link')->nullable();
            $table->text('class_test_link')->nullable();
            $table->string('mark')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();  // Keep only one call to timestamps()
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
