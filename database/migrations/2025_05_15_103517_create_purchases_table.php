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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('insurance_id');
            $table->string('provider_type')->nullable();
            $table->string('policy_no')->nullable();
            $table->string('policy_holder_type')->nullable();
            $table->string('policy_holder_title')->nullable();
            $table->string('policy_holder_fname')->nullable();
            $table->string('policy_holder_lname')->nullable();
            $table->string('policy_holder_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('policy_holder_address')->nullable();
            $table->string('policy_holder_email')->nullable();
            $table->string('policy_holder_phone')->nullable();
            $table->date('policy_start_date')->nullable();
            $table->date('policy_end_date')->nullable();
            $table->string('transaction_type')->nullable();
            $table->double('payable_amount')->nullable();
            $table->string('property_address')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
