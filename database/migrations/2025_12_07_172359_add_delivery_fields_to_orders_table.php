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
        Schema::table('orders', function (Blueprint $table) {
            $table->text('delivery_message')->nullable()->after('requirements');
            $table->string('delivery_file')->nullable()->after('delivery_message');
            $table->timestamp('delivered_at')->nullable()->after('delivery_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_message', 'delivery_file', 'delivered_at']);
        });
    }
};
