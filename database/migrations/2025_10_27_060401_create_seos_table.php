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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ref_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('page_title')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('locale')->nullable();
            $table->string('page_type')->nullable();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->string('site_name')->nullable();
            $table->string('ogimage')->nullable();
            $table->string('twitter_card')->nullable();
            $table->string('twitter_site')->nullable();
            $table->string('twitter_title')->nullable();
            $table->longText('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->tinyInteger('has_short_slug')->default(0);
            $table->string('short_slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
