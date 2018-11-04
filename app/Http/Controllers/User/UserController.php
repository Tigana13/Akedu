<?php

namespace App\Http\Controllers\User;

use App\Models\College\College;
use App\Models\Course\Course;
use App\Models\ExitSurvey\ExitSurvey;
use App\Models\Interests\Interestable;
use App\Models\Interests\Interests;
use App\Models\User\UserProfile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Profile view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $interests = \auth()->user()->interests;
        return view('user.profile.user_profile',compact('interests'));
    }

    /**
     * Update user profile
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:120',
            'email' => 'required|string|max:60',
            'phone_number' => 'nullable|string|max:40',
            'dob' => 'nullable|string|max:20',
            'is_student' => 'nullable|boolean',
            'occupation' => 'nullable|string|max:30',
            'admission_year' =>  'nullable|string|max:30',
            'college' => 'nullable|integer'
        ]);

        if ($validator->fails()){
            return back()->with('error', 'There was an error processing your input.')->withErrors($validator)->withInput();
        }

        $college = College::findOrFail($request->college);

        $user = Auth::user();
        $profile = (Auth::user()->profile == null) ? new UserProfile(): Auth::user()->profile;
        $profile->user_id = $user->id;
        $profile->phone_number = ($request->phone_number != null) ? $request->phone_number : $profile->phone_number;
        $profile->dob = ($request->dob != null) ? $request->dob : $profile->dob ;
        $profile->is_student = ($request->is_student == null) ? 0 : 1;
        $profile->occupation = ($request->occupation != null) ? $request->occupation : $profile->occupation;
        $profile->college_id = $college->id;
        $profile->admission_year = ($request->admission_year == null) ? $profile->admission_year : $request->admission_year;
        $profile->save();
        $user->save();

        return back()->with('success', 'Success. Your profile was updated successfully');
    }


    /**
     * Add users' interests to his profile
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInterests(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'interests.*' => 'integer'
        ]);

        if ($validator->fails() || !$request->has('interests')){
            return back()->with('error', 'Wrong interest input');
        }

        foreach ($request->interests as $interest_id){
            $interest = Interests::findOrFail($interest_id);
            if (Interestable::where('interests_id', $interest_id)->where('interestables_id', Auth::id())->where('interestables_type', User::class)->count() == 0){
                Interestable::create([
                    'interests_id' => $interest->id,
                    'interestables_id' => Auth::id(),
                    'interestables_type' => User::class
                ]);
            }
        }

        return back()->with('success', 'Interests added successfully');
    }

    /**
     * Show exit survey form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showExitSurveyForm()
    {
        return view('user.exit_survey.survey_form');

        /**
         * ********************************
         * FORM FIELDS
         * ********************************
         *
         * start_year
         * completion_year
         * professional_ethics
         * communication_skills
         * theory_prac_application
         * current_field_trends
         * written_communication
         * critical_thinking
         * team_member_functionality
         * independent_learner
         * satisfactory_rigor
         * further_education_career
         * strong_leadership_skills
         * acceptance_at_institution
         * faculty_support
         * return_for_social_activities
         * employment_preparation
         */
    }

    /**
     * Store a user's exit survey
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addExitSurvey(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'professional_ethics' => 'required|integer|max:2|min:-1',
            'communication_skills' => 'required|integer|max:2|min:-1',
            'start_year' => 'required|date',
            'completion_year' => 'required|date',
            'theory_prac_application' => 'required|integer|max:2|min:-1',
            'current_field_trends' => 'required|integer|max:2|min:-1',
            'written_communication' => 'required|integer|max:2|min:-1',
            'critical_thinking' => 'required|integer|max:2|min:-1',
            'team_member_functionality' => 'required|integer|max:2|min:-1',
            'independent_learner' => 'required|integer|max:2|min:-1',
            'further_education_career' => 'required|integer|max:2|min:-1',
            'strong_leadership_skills' => 'required|integer|max:2|min:-1',
            'acceptance_at_institution' => 'required|integer|max:2|min:-1',
            'faculty_support' => 'required|integer|max:2|min:-1',
            'return_for_social_activities' => 'required|integer|max:2|min:-1',
            'employment_preparation' => 'required|integer|max:2|min:-1',
        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator)->with('error', 'An inconsistency was detected in your request');
        }

        ExitSurvey::create([
            'user_id' => Auth::id(),
            'college_id' => ($request->has('college')) ? College::findOrFail($request->college)->id: \auth()->user()->profile->college_id,
            'course_id' => Course::findOrFail($request->course)->id,
            'start_year' => $request->start_year,
            'completion_year' => $request->completion_year,
            'professional_ethics_rating' => $request->professional_ethics,
            'communication_skills_rating' => $request->communication_skills,
            'theory_prac_application_rating' => $request->theory_prac_application,
            'current_field_trends_rating' => $request->current_field_trends,
            'written_communication_rating' => $request->written_communication,
            'critical_thinking_rating' => $request->critical_thinking,
            'team_member_functionality_rating' => $request->team_member_functionality,
            'independent_learner_rating' => $request->independent_learner,
            'further_education_career_rating' => $request->further_education_career,
            'strong_leadership_skills_rating' => $request->strong_leadership_skills,
            'acceptance_at_institution_rating' => $request->acceptance_at_institution,
            'faculty_support_rating' => $request->faculty_support,
            'return_for_social_activities_rating' => $request->return_for_social_activities,
            'employment_preparation_rating' => $request->employment_preparation,
        ]);

        return redirect(route('user.profile'))->with('success', 'Your exit survey was successfully submitted. Thank you');
    }
}

