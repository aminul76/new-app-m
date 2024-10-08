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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('site_name')->nullable();
            $table->text('site_title')->nullable();
            $table->text('site_short_description')->nullable();
            $table->text('site_description')->nullable();
            $table->string('site_image')->nullable();
            $table->string('site_share_image')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('keyword')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
