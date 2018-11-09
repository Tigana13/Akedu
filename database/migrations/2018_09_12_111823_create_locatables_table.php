<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocatablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locatables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('locations_id');
            $table->foreign('locations_id')
                ->references('id')->on('locations');
            $table->morphs('locatable');
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
        Schema::dropIfExists('locatables');
    }
}
