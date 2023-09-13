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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('travel_package_id', 'fk_transactions_travel_packages')->references('id')
                ->on('travel_packages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'fk_transactions_users')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('fk_transactions_travel_packages');
            $table->dropForeign('fk_transactions_users');
        });
    }
};
