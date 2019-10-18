<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorsTable extends Migration
{
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table){
            $table->bigIncrements('id')->index();
            $table->string('name')->index();
            $table->enum('type', ['abuse','negative','mention']);
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitors');
    }
}