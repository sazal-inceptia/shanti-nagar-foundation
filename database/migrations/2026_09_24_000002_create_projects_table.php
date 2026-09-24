<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category', 100)->nullable(); // e.g. Health, Education, Relief, Orphan Care, Social Welfare
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('estimated_cost', 14, 2)->default(0.00);
            $table->decimal('total_expense', 14, 2)->default(0.00);
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'cancelled'])->default('planned');
            $table->string('location')->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
