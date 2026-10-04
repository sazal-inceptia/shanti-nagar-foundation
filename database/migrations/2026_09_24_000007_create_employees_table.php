<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 50)->unique();
            $table->string('name');
            $table->foreignId('designation_id')->nullable()->constrained('designations')->nullOnDelete();
            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('nid_number', 50)->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->date('joining_date');
            $table->decimal('base_salary', 12, 2)->default(0.00);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_highlight')->default(false);
            $table->string('photo')->nullable();
            $table->text('speech')->nullable();
            $table->string('speech_tag', 150)->nullable();
            $table->text('bio')->nullable();
            $table->string('signature_text', 150)->nullable();
            $table->string('signature_title', 150)->nullable();
            $table->string('badge_title', 100)->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
