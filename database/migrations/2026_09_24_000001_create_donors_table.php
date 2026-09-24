<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->index();
            $table->string('phone', 30)->nullable()->index();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('country', 100)->default('Bangladesh');
            $table->enum('donor_type', ['individual', 'organization'])->default('individual');
            $table->boolean('is_anonymous')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
