<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypesOnExitSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exit_surveys', function (Blueprint $table) {
            $table->text('professional_ethics_rating')->change();
            $table->text('communication_skills_rating')->change();
            $table->text('theory_prac_application_rating')->change();
            $table->text('current_field_trends_rating')->change();
            $table->text('written_communication_rating')->change();
            $table->text('critical_thinking_rating')->change();
            $table->text('team_member_functionality_rating')->change();
            $table->text('independent_learner_rating')->change();
            $table->text('further_education_career_rating')->change();
            $table->text('strong_leadership_skills_rating')->change();
            $table->text('acceptance_at_institution_rating')->change();
            $table->text('faculty_support_rating')->change();
            $table->text('return_for_social_activities_rating')->change();
            $table->text('employment_preparation_rating')->change();
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
