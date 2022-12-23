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
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('account_id');
            $table->string('marketplace_id');
            $table->float('daily_budget', 16);

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts');

            $table->foreign('marketplace_id')
                ->references('id')
                ->on('marketplaces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
