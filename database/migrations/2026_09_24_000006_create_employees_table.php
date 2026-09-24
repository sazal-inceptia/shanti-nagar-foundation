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
            $table->string('designation', 100);
            $table->string('department', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('nid_number', 50)->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->date('joining_date');
            $table->decimal('base_salary', 12, 2)->default(0.00);
            $table->enum('employment_status', ['active', 'on_leave', 'resigned', 'terminated'])->default('active');
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
