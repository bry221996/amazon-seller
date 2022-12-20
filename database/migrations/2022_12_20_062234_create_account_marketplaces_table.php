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
        Schema::create('account_marketplaces', function (Blueprint $table) {
            $table->string('account_id');
            $table->string('marketplace_id');
            $table->bigInteger('profile_id')->unique()->nullable();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts');

            $table->foreign('marketplace_id')
                ->references('id')
                ->on('marketplaces');

            $table->primary(['account_id', 'marketplace_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_marketplaces');
    }
};
