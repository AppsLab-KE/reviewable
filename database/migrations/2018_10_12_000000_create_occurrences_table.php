<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccurrencesTable extends Migration
{
    public function up()
    {
        Schema::create('occurrences', function (Blueprint $table){
            $table->bigIncrements('id')->index();
            $table->morphs('occurrable');
            $table->string('status')->default('pending');
            $table->integer('count')->nullable();
            $table->enum('type',['abuse','negative','mention'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('occurrences');
    }
}