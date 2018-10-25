<?php

namespace App\Http\Controllers\College;

use App\Models\College\College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CollegeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges = College::with('courses', 'facilities', 'intakes', 'images', 'locations.country')->paginate(9);

        return view('user.landing', compact('colleges'));
    }

    /**
     * Show the profile for a single college
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $college = College::with('courses', 'facilities', 'intakes', 'images', 'locations.country', 'profile','bannerimages')->findOrFail($id);

        return view('college.profile.college_profile', compact('college'));
    }

    /**
     * Search DB for college record according to request
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_query' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $search_query = $request->search_query;

        $colleges = College::with('courses', 'facilities', 'intakes', 'images', 'locations.country')
            ->where('college_name', 'like', "%{$search_query}%")
            ->orWhere('college_email', 'like', "%{$search_query}%")
            ->orWhereHas('profile', function ($query) use ($search_query){
                $query->where('college_description', 'like', "%{$search_query}%")
                    ->orWhere('date_founded', 'like', "%{$search_query}%");
            })
            ->orWhereHas('courses', function ($query) use ($search_query){
                $query->where('course_name', 'like', "%{$search_query}%")
                    ->orWhere('certified', 'like', "%{$search_query}%");
            })
            ->orWhereHas('courses.profile', function ($query) use ($search_query){
                $query->where('course_description', 'like', "%{$search_query}%")
                    ->orWhere('course_credits', 'like', "%{$search_query}%")
                    ->orWhere('course_qualifications', 'like', "%{$search_query}%")
                    ->orWhere('course_duration', 'like', "%{$search_query}%");
            })
            ->orWhereHas('facilities', function ($query) use ($search_query){
                $query->where('facility_name', 'like', "%{$search_query}%")
                    ->orWhere('facility_description', 'like', "%{$search_query}%")
                    ->orWhere('credits', 'like', "%{$search_query}%")
                    ->orWhere('certified', 'like', "%{$search_query}%");
            })
            ->orWhereHas('intakes', function ($query) use ($search_query){
                $query->where('intake_alias', 'like', "%{$search_query}%")
                    ->orWhere('intake_description', 'like', "%{$search_query}%")
                    ->orWhere('intake_start', 'like', "%{$search_query}%")
                    ->orWhere('intake_finish', 'like', "%{$search_query}%");
            })
            ->orWhereHas('locations', function ($query) use ($search_query){
                $query->where('latitude', 'like', "%{$search_query}%")
                    ->orWhere('longitude', 'like', "%{$search_query}%")
                    ->orWhere('address', 'like', "%{$search_query}%")
                    ->orWhere('city', 'like', "%{$search_query}%");
            })
            ->orWhereHas('locations.country', function ($query) use ($search_query){
                $query->where('country_name', 'like', "%{$search_query}%")
                    ->orWhere('country_code', 'like', "%{$search_query}%")
                    ->orWhere('country_extension', 'like', "%{$search_query}%")
                    ->orWhere('region_code', 'like', "%{$search_query}%")
                    ->orWhere('continent', 'like', "%{$search_query}%");

            });

        $hit_count = $colleges->count();
        $colleges = $colleges->get();

        return view('user.search.search', compact('colleges', 'search_query', 'hit_count'));
    }
}
