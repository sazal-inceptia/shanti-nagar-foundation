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
        // 1. Projects Table
        Schema::table('projects', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('short_description_bn')->nullable()->after('short_description');
            $table->longText('description_bn')->nullable()->after('description');
            $table->string('location_bn')->nullable()->after('location');
        });

        // 2. Project Types Table
        Schema::table('project_types', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('description_bn')->nullable()->after('description');
        });

        // 3. Project Images Table
        Schema::table('project_images', function (Blueprint $table) {
            $table->string('caption_bn')->nullable()->after('caption');
        });

        // 4. Designations Table
        Schema::table('designations', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
        });

        // 5. Employees Table
        Schema::table('employees', function (Blueprint $table) {
            $table->string('name_bn')->nullable()->after('name');
            $table->text('bio_bn')->nullable()->after('bio');
        });

        // 6. Volunteers Table
        Schema::table('volunteers', function (Blueprint $table) {
            $table->text('notes_bn')->nullable()->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn('notes_bn');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'bio_bn']);
        });

        Schema::table('designations', function (Blueprint $table) {
            $table->dropColumn('name_bn');
        });

        Schema::table('project_images', function (Blueprint $table) {
            $table->dropColumn('caption_bn');
        });

        Schema::table('project_types', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'description_bn']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'short_description_bn', 'description_bn', 'location_bn']);
        });
    }
};
