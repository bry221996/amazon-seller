<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('portfolio_id')->nullable();
            $table->string('name', 512);
            $table->decimal('budget');
            $table->string('budget_type');
            $table->string('state');
            $table->string('targeting_type')->nullable();
            $table->enum('campaignType', ['sponsoredProducts', 'sponsoredBrands', 'sponsoredDisplay']);
            $table->jsonb('dynamicBidding')->nullable();
            $table->string('serving_status')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('ad_format')->nullable();
            $table->jsonb('creative')->nullable();
            $table->jsonb('landing_page')->nullable();
            $table->jsonb('supply_source')->nullable();
            $table->string('tactic')->nullable();
            $table->string('cost_type')->nullable();
            $table->string('delivery_profile')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
