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
        Schema::table('policyreferralforms', function (Blueprint $table) {
            $table->string('insurances_required')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policyreferralforms', function (Blueprint $table) {
            $table->integer('insurances_required')->change();
        });
    }
};
