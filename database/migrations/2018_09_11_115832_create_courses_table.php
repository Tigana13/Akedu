<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_name');
            $table->unsignedInteger('college_id');
            $table->foreign('college_id')
                ->references('id')
                ->on('colleges')
                ->onDelete('cascade');
            $table->unsignedInteger('course_intake');
            $table->foreign('course_intake')
                ->references('id')
                ->on('intakes')
                ->onDelete('cascade');
            $table->tinyInteger('active');
            $table->tinyInteger('certified');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
