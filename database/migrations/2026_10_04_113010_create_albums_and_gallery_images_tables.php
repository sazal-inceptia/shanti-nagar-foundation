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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('cover_image')->nullable();
            $table->date('event_date')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->nullable()->constrained('albums')->nullOnDelete();
            $table->string('title')->nullable();
            $table->string('title_bn')->nullable();
            $table->text('caption')->nullable();
            $table->text('caption_bn')->nullable();
            $table->string('image_path');
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('albums');
    }
};
