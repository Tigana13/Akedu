<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facilities', function (Blueprint $table){
            $table->foreign('college_id')
                ->references('id')
                ->on('colleges')
                ->onDelete('cascade');
        });

        Schema::table('courses', function (Blueprint $table){
            $table->foreign('college_id')
                ->references('id')
                ->on('colleges')
                ->onDelete('cascade');

            $table->foreign('course_intake')
                ->references('id')
                ->on('intakes')
                ->onDelete('cascade');
        });

        Schema::table('college_profiles', function (Blueprint $table){
            $table->foreign('college_id')
                ->references('id')
                ->on('colleges')
                ->onDelete('cascade');
        });

        Schema::table('locations', function(Blueprint $table){
            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
        });

        Schema::table('intakes', function(Blueprint $table){
            $table->foreign('college_id')
                ->references('id')
                ->on('colleges')
                ->onDelete('cascade');
        });

        Schema::table('course_profiles', function(Blueprint $table){
           $table->foreign('course_id')
               ->references('id')
               ->on('courses')
               ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facilities', function (Blueprint $table){
            $table->dropForeign('facilities_college_id_foreign');
        });

        Schema::table('courses', function (Blueprint $table){
            $table->dropForeign('courses_college_id_foreign');
            $table->dropForeign('courses_course_intake_foreign');
        });

        Schema::table('college_profiles', function (Blueprint $table){
            $table->dropForeign('college_profiles_college_id_foreign');
        });

        Schema::table('locations', function(Blueprint $table){
            $table->dropForeign('locations_country_id_foreign');
        });

        Schema::table('intakes', function(Blueprint $table){
            $table->dropForeign('intakes_college_id_foreign');
        });

        Schema::table('course_profiles', function(Blueprint $table){
            $table->dropForeign('course_profiles_course_id_foreign');
        });
    }
}
