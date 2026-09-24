<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('salary_slip_number', 50)->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('month_year', 20); // e.g. "January 2026", "2026-01"
            $table->decimal('basic_amount', 12, 2);
            $table->decimal('allowance', 12, 2)->default(0.00);
            $table->decimal('bonus', 12, 2)->default(0.00);
            $table->decimal('deductions', 12, 2)->default(0.00);
            $table->decimal('net_paid_amount', 12, 2);
            $table->date('payment_date');
            $table->string('payment_method', 50)->default('bank_transfer'); // Cash, Bank, bKash
            $table->string('transaction_reference')->nullable();
            $table->enum('status', ['paid', 'pending'])->default('paid');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
