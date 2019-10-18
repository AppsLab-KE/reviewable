<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('reviewable.tables.item'), function (Blueprint $table) {
            $table->double('rate_cache')->nullable();
//            $table->
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('reviewable.tables.item'), function (Blueprint $table) {
//            $table->
        });
    }
}
