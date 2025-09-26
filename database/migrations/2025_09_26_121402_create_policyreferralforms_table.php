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
        Schema::create('policyreferralforms', function (Blueprint $table) {
            $table->id();
            $table->char('token', 36)->nullable()->index();
            $table->unsignedBigInteger('insurance_id');
            $table->string('stripe_session_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('product_type')->nullable();
            $table->string('policy_no')->nullable();
            $table->string('policy_holder_type')->nullable();
            $table->string('policy_holder_title')->nullable();
            $table->string('policy_holder_fname')->nullable();
            $table->string('policy_holder_lname')->nullable();
            $table->string('policy_holder_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('policy_holder_address')->nullable();
            $table->string('policy_holder_email')->nullable();
            $table->string('copy_email')->nullable();
            $table->string('policy_holder_phone')->nullable();
            $table->date('policy_start_date')->nullable();
            $table->string('ast_start_date')->nullable();
            $table->date('policy_end_date')->nullable();
            $table->string('transaction_type')->nullable();
            $table->double('payable_amount')->nullable();
            $table->string('property_address')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('tenant_name')->nullable();
            $table->string('tenant_email')->nullable();
            $table->string('tenant_phone')->nullable();
            $table->integer('rent_amount')->nullable();
            $table->string('insurance_type')->nullable();
            $table->string('door_no')->nullable();
            $table->text('address_one')->nullable();
            $table->text('address_two')->nullable();
            $table->text('address_three')->nullable();
            $table->string('post_code')->nullable();
            $table->text('policy_holder_address_one')->nullable();
            $table->text('policy_holder_address_two')->nullable();
            $table->text('policy_holder_alternative_phone')->nullable();
            $table->text('policy_holder_postcode')->nullable();
            $table->string('policy_holder_company_email')->nullable();
            $table->string('policy_holder_company_phone')->nullable();
            $table->integer('policy_term')->nullable();
            $table->date('purchase_date')->nullable();
            $table->double('net_premium')->default(0);
            $table->double('commission')->default(0);
            $table->double('gross_premium')->default(0);
            $table->double('ipt')->default(0);
            $table->double('total_premium')->default(0);
            $table->double('ipt_on_billable_amount')->default(0);
            $table->double('admin_fee', 10, 2)->default(0.00);
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('Pending');
            $table->string('purchase_status')->nullable();
            $table->text('purchase_cancel_reason')->nullable();
            $table->string('insurances_required')->nullable();
            $table->integer('year_of_purchase')->nullable();
            $table->integer('year_of_build')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policyreferralforms');
    }
};
