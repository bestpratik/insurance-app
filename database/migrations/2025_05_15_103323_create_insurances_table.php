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
            $table->string('name')->nullable();
            $table->string('provider_type')->nullable();
            $table->string('slug')->nullable();
            $table->string('prefix')->nullable();
            $table->double('net_premium')->nullable();
            $table->double('commission')->nullable();
            $table->double('gross_premium')->nullable();
            $table->double('ipt')->nullable();
            $table->double('total_premium')->nullable();
            $table->double('payable_amount')->nullable();
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
