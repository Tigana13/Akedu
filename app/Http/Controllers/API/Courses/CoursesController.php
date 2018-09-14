<?php

namespace App\Http\Controllers\API\Courses;

use App\Http\Resources\Courses\CoursesResource;
use App\Models\Course\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $courses = Course::with(['college', 'intakes'])->paginate(10);

        return CoursesResource::collection($courses);
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
     * @return CoursesResource
     */
    public function store(Request $request)
    {
        $course = $request->isMethod('put') ? Course::findOrFail($request->course_id) : new Course();

        $course->course_name = $request->course_name;
        $course->college_id = $request->college_id;
        $course->course_intake = $request->course_intake;
        $course->active = 0;
        $course->certified = 0;

        if ($course->save()){
            return new CoursesResource($course);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CoursesResource
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return new CoursesResource($course);
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
     * @return CoursesResource
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->delete()){
            return new CoursesResource($course);
        }
    }
}
