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
        Schema::create('insurancedynamicdocuments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('insurance_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('header')->nullable();
            $table->longText('description')->nullable();
            $table->longText('footer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurancedynamicdocuments');
    }
};
