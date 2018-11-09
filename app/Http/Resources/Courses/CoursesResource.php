<?php

namespace App\Http\Resources\Courses;

use App\Http\Resources\Colleges\CollegesResource;
use App\Http\Resources\Comments\CommentsResource;
use App\Http\Resources\Intakes\IntakesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'course_name' => $this->course_name,
            'certified' => $this->certified,
            'sentiment_score' => $this->sentiment_score_average,
            'popularity' => $this->sentiment_magnitude_average,
            'professional_ethics_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('professional_ethics_rating'): 0,
            'communication_skills_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('communication_skills_rating'): 0,
            'theory_prac_application_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('theory_prac_application_rating_score'): 0,
            'current_field_trends_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('current_field_trends_rating_score'): 0,
            'written_communication_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('written_communication_rating_score'): 0,
            'critical_thinking_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('critical_thinking_rating_score'): 0,
            'team_member_functionality_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('team_member_functionality_rating_score'): 0,
            'independent_learner_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('independent_learner_rating_score'): 0,
            'further_education_career_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('further_education_career_rating_score'): 0,
            'strong_leadership_skills_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('strong_leadership_skills_rating_score'): 0,
            'acceptance_at_institution_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('acceptance_at_institution_rating_score'): 0,
            'faculty_support_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('faculty_support_rating_score'): 0,
            'social_activities_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('return_for_social_activities_rating_score'): 0,
            'employment_preparation_rating' => ($this->exitSurveys->isNotEmpty())? $this->exitSurveys->avg('employment_preparation_rating_score'): 0,
            'colleges' => CollegesResource::collection($this->whenLoaded('colleges')),
            'comments' => CommentsResource::collection($this->whenLoaded('comments')),
            'intakes' => IntakesResource::collection($this->whenLoaded('intakes')),
        ];
    }
}
