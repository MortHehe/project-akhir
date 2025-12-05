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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('location')->nullable()->after('phone');
            $table->string('company')->nullable()->after('location');
            $table->string('industry', 100)->nullable()->after('company');
            $table->string('company_size', 50)->nullable()->after('industry');
            $table->string('website')->nullable()->after('company_size');
            $table->text('company_description')->nullable()->after('website');
            $table->text('notification_settings')->nullable()->after('company_description');
            $table->text('bio')->nullable()->after('notification_settings');
            $table->text('skills')->nullable()->after('bio');
            $table->decimal('hourly_rate', 10, 2)->nullable()->after('skills');
            $table->string('availability', 50)->nullable()->after('hourly_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'location',
                'company',
                'industry',
                'company_size',
                'website',
                'company_description',
                'notification_settings',
                'bio',
                'skills',
                'hourly_rate',
                'availability',
            ]);
        });
    }
};
