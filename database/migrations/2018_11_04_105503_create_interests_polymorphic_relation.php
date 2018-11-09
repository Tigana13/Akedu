<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsPolymorphicRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interestables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('interests_id');
            $table->foreign('interests_id')->references('id')->on('interests');
            $table->morphs('interestables');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interestables');
    }
}
