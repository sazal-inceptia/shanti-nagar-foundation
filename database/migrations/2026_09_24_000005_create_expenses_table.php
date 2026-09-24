<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_number', 50)->unique();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->string('expense_category', 100); // e.g. Project Distribution, Operational, Rent, Utilities, Transport, Miscellaneous
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 14, 2);
            $table->date('expense_date');
            $table->string('payment_method', 50)->default('cash');
            $table->string('recipient_or_vendor')->nullable();
            $table->string('receipt_voucher_file')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
