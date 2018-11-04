<?php

namespace App\Models\ExitSurvey;

use Illuminate\Database\Eloquent\Model;

class ExitSurvey extends Model
{
    protected $fillable=[
        'user_id',
        'college_id',
        'course_id',
        'professional_ethics_rating',
        'communication_skills_rating',
        'theory_prac_application_rating',
        'current_field_trends_rating',
        'written_communication_rating',
        'critical_thinking_rating',
        'team_member_functionality_rating',
        'independent_learner_rating',
        'further_education_career_rating',
        'strong_leadership_skills_rating',
        'acceptance_at_institution_rating',
        'faculty_support_rating',
        'return_for_social_activities_rating',
        'employment_preparation_rating',
    ];


}
