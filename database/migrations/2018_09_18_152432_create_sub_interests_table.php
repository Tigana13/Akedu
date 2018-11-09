<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_interests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('interest_id');
            $table->foreign('interest_id')
                ->references('id')->on('interests');
            $table->string('sub_interest');
            $table->string('sub_interest_icon');
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
        Schema::dropIfExists('sub_interests');
    }
}
