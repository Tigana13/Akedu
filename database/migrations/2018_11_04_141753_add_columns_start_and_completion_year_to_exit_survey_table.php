<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsStartAndCompletionYearToExitSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exit_surveys', function (Blueprint $table) {
            $table->date('start_year')->after('course_id')->nullable();
            $table->date('completion_year')->after('course_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exit_surveys', function (Blueprint $table) {
            $table->dropColumn('start_year');
            $table->dropColumn('completion_year');
        });
    }
}
