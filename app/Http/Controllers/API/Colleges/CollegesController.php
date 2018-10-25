<?php

namespace App\Http\Controllers\API\Colleges;

use App\Http\Resources\Colleges\CollegesResource;
use App\Models\College\College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CollegesController extends Controller
{
    public function __construct()
    {
//        $this->middleware();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $colleges = College::with(['courses', 'facilities', 'intakes', 'images', 'locations.country'])->get();

        return CollegesResource::collection($colleges);
    }


    public function relation($relation = null)
    {
        $colleges = College::with($relation)->get();

        return CollegesResource::collection($colleges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CollegesResource
     */
    public function store(Request $request)
    {
        $college = $request->isMethod('put') ? College::findOrFail($request->college_id) : new College();

        $college->college_name = $request->college_name;
        $college->college_email = $request->college_email;
        $college->password = ($request->has('password')) ? $request->password : Hash::make('secretpassword');

        if ($college->save()){
            return new CollegesResource($college);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CollegesResource
     */
    public function show($id)
    {
        $college = College::findOrFail($id);

        return new CollegesResource($college);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return CollegesResource
     */
    public function destroy($id)
    {
        $college = College::findOrFail($id);

        if ($college->delete()){
            return new CollegesResource($college);
        }
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_query' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()){
            return abort(203);
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

            })
            ->get();

        return CollegesResource::collection($colleges);
    }

}
