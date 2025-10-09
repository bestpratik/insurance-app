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
            $table->string('rent_arrears')->nullable()->after('year_of_build');
            $table->integer('no_of_bedroom')->default(0)->after('rent_arrears');
            $table->string('referral_name')->nullable()->after('no_of_bedroom');
            $table->string('referral_email')->nullable()->after('referral_name');
            $table->string('council_name')->nullable()->after('referral_email');
            $table->string('council_officer_name')->nullable()->after('council_name');
            $table->string('council_officer_email')->nullable()->after('council_officer_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policyreferralforms', function (Blueprint $table) {
            $table->dropColumn('rent_arrears', 'no_of_bedroom', 'referral_name', 'referral_email', 'council_name', 'council_officer_name', 'council_officer_email');
        });
    }
};
