<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('favorites_id')->foreign('favorites_id')
                ->references('id')->on('favorites');
            $table->unsignedInteger('user_id')
                ->nullable()
                ->foreign('user_id')
                ->references('id')->on('users');
            $table->morphs('favoritable');
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
        Schema::dropIfExists('favoritables');
    }
}
