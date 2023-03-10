<?php

use App\Models\Account\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('regions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
        });

        Region::insert([
            ['id' => 'na', 'name' => 'North America'],
            ['id' => 'eu', 'name' => 'Europe'],
            ['id' => 'fe', 'name' => 'Far East']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
};
