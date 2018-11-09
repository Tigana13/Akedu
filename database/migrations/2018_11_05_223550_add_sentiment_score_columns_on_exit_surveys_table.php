<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSentimentScoreColumnsOnExitSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exit_surveys', function (Blueprint $table) {
            $table->double('professional_ethics_rating_score')->after('professional_ethics_rating')->nullable();
            $table->double('communication_skills_rating_score')->after('communication_skills_rating')->nullable();
            $table->double('theory_prac_application_rating_score')->after('theory_prac_application_rating')->nullable();
            $table->double('current_field_trends_rating_score')->after('current_field_trends_rating')->nullable();
            $table->double('written_communication_rating_score')->after('written_communication_rating')->nullable();
            $table->double('critical_thinking_rating_score')->after('critical_thinking_rating')->nullable();
            $table->double('team_member_functionality_rating_score')->after('team_member_functionality_rating')->nullable();
            $table->double('independent_learner_rating_score')->after('independent_learner_rating')->nullable();
            $table->double('further_education_career_rating_score')->after('further_education_career_rating')->nullable();
            $table->double('strong_leadership_skills_rating_score')->after('strong_leadership_skills_rating')->nullable();
            $table->double('acceptance_at_institution_rating_score')->after('acceptance_at_institution_rating')->nullable();
            $table->double('faculty_support_rating_score')->after('faculty_support_rating')->nullable();
            $table->double('return_for_social_activities_rating_score')->after('return_for_social_activities_rating')->nullable();
            $table->double('employment_preparation_rating_score')->after('employment_preparation_rating')->nullable();
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
            //
        });
    }
}
