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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('tenure', 100)->nullable()->after('badge_title');
            $table->string('year_badge', 50)->nullable()->after('tenure');
            $table->string('rotary_theme')->nullable()->after('year_badge');
            $table->string('rotary_theme_bn')->nullable()->after('rotary_theme');
            $table->string('focus_area')->nullable()->after('rotary_theme_bn');
            $table->string('focus_area_bn')->nullable()->after('focus_area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'tenure',
                'year_badge',
                'rotary_theme',
                'rotary_theme_bn',
                'focus_area',
                'focus_area_bn',
            ]);
        });
    }
};
