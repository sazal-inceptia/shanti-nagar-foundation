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
            $table->foreignId('project_type_id')->nullable()->constrained('project_types')->nullOnDelete();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('background')->nullable();
            $table->longText('background_bn')->nullable();
            $table->json('objectives')->nullable();
            $table->json('objectives_bn')->nullable();
            $table->json('impact_outcomes')->nullable();
            $table->json('impact_outcomes_bn')->nullable();
            $table->json('challenges')->nullable();
            $table->json('challenges_bn')->nullable();
            $table->longText('conclusion')->nullable();
            $table->longText('conclusion_bn')->nullable();
            $table->json('project_report_meta')->nullable();
            $table->decimal('estimated_cost', 14, 2)->default(0.00);
            $table->decimal('total_expense', 14, 2)->default(0.00);
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'cancelled'])->default('planned');
            $table->string('location')->nullable();
            $table->string('target_beneficiaries')->nullable();
            $table->string('target_beneficiaries_bn')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('video_url')->nullable();
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
