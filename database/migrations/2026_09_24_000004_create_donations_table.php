<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number', 50)->unique();
            $table->foreignId('donor_id')->nullable()->constrained('donors')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete(); // General or specific project
            $table->decimal('amount', 14, 2);
            $table->string('currency', 10)->default('BDT');
            $table->string('payment_method', 50)->default('cash'); // bKash, Nagad, Bank, Cash, etc.
            $table->string('transaction_id')->nullable();
            $table->date('donation_date');
            $table->string('purpose')->nullable(); // e.g. Zakat, General Fund, Orphan Support, Hospital Fan
            $table->enum('status', ['completed', 'pending', 'cancelled'])->default('completed');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
