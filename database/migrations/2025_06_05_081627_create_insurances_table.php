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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_insurance')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('provider_type')->nullable();
            $table->string('prefix')->nullable();
            $table->double('rent_amount_from')->default(0.00)->nullable();
            $table->double('rent_amount_to')->default(0.00)->nullable();
            $table->text('validity')->nullable();
            $table->double('net_premium')->default(0.00)->nullable();
            $table->double('commission')->default(0.00)->nullable();
            $table->double('gross_premium')->default(0.00)->nullable();
            $table->double('ipt')->default(0.00)->nullable();
            $table->double('total_premium')->default(0.00)->nullable();
            $table->double('payable_amount')->default(0.00)->nullable();
            $table->double('ipt_on_billable_amount')->default(0.00)->nullable();
            $table->double('admin_fee')->default(0)->nullable();
            $table->longText('details_of_cover')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
