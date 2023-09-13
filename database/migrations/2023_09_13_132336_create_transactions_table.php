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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_package_id')->nullable()->index('fk_transactions_travel_packages');
            $table->foreignId('user_id')->nullable()->index('fk_transactions_users');
            $table->integer('additional_visa');
            $table->bigInteger('transaction_total');
            $table->enum('transaction_status', ['IN_CART', 'PENDING', 'SUCCESS', 'CANCEL', 'FAILED']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
