<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExitSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exit_surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('college_id')->nullable();
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('professional_ethics_rating');
            $table->integer('communication_skills_rating');
            $table->integer('theory_prac_application_rating');
            $table->integer('current_field_trends_rating');
            $table->integer('written_communication_rating');
            $table->integer('critical_thinking_rating');
            $table->integer('team_member_functionality_rating');
            $table->integer('independent_learner_rating');
            $table->integer('further_education_career_rating');
            $table->integer('strong_leadership_skills_rating');
            $table->integer('acceptance_at_institution_rating');
            $table->integer('faculty_support_rating');
            $table->integer('return_for_social_activities_rating');
            $table->integer('employment_preparation_rating');
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
        Schema::dropIfExists('exit_surveys');
    }
}
