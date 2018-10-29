<?php

namespace App\Http\Controllers\API\Courses;

use App\Http\Resources\Courses\CoursesResource;
use App\Models\Comments\Comments;
use App\Models\Course\Course;
use App\Models\Threads\Threads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $courses = Course::with(['college','intakes','facilities'])->paginate(10);  
        return CoursesResource::collection($courses);
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

    /**
     * Show a forum belonging to a specific course
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForum($id)
    {
        $course = Course::findOrFail($id);
        $threads = $course->threads;
        $topics = $course->topics;

        $response = array(
            'course' => $course,
            'threads' => $threads,
            'topics' => $topics
        );

        return response()->json($response);
    }


    /**
     * Add a comment on a particular course
     *
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCourseComment(Request $request, $course_id)
    {
        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string|max:180'
        ]);

        if ($validator->fails()){
            return response()->json(['message' => 'Validation failed','error' => $validator->errors()], 417);
        }

        $course = Course::findOrFail($course_id);

        $comment = new Comments();
        $comment->user_id = auth()->id();
        $comment->body = $request->comment_body;

        $course->comments()->save($comment);

        return response()->json(['message' => 'Comment added successfully', 'comment' => $comment], 200);

    }

    /**
     * Create a thread on a course
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createCourseThread(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thread_subject' => 'required|string|max:180',
            'thread_title' => 'required|string|max:180',
            'course_id' => 'required|integer'
        ]);

        if ($validator->fails()){
            return response()->json(['message' => 'Validation failed', 'error' => $validator->errors()], 417);
        }

        $course = Course::findOrFail($request->course_id);

        $thread = new Threads();
        $thread->thread = $request->thread_title;
        $thread->subject = $request->thread_subject;
        $thread->threadable_type = Course::class;
        $thread->threadable_id = $course->id;

        $course->threads()->save($thread);

        return response()->json(['message' => 'Thread created successfully','thread' => $thread], 200);

    }


    /**
     * Show a single thread belonging to a course
     * @param $course_id
     * @param $thread_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCourseThread($course_id, $thread_id)
    {
        $thread = Threads::findOrFail($thread_id);

        $course = Course::findOrFail($course_id);

        return response()->json(['course'=> $course, 'thread' => $thread]);
    }

    /**
     * Add a comment to a course's thread
     * @param Request $request
     * @param $thread_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addThreadComment(Request $request, $thread_id)
    {

        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string|max:180'
        ]);

        if ($validator->fails()){
            return response()->json(['message' => 'Validation failed','error' => $validator->errors()], 417);
        }

        $thread = Threads::findOrFail($thread_id);

        $comment = new Comments();
        $comment->user_id = auth()->id();
        $comment->body = $request->comment_body;

        $thread->comments()->save($comment);

        return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 200);

    }

    /**
     * Search for threads related to a course
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function searchThreads(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
            'search_query' => 'required|string|max:200'
        ]);

        if ($validator->fails()){
            return response()->json(['message' => 'Validation failed', 'error' => $validator->errors()], 417);
        }

        $course = Course::findOrFail($request->course_id);

        $threads = $course->threads()->where('subject', 'like', "%{$request->search_query}%")->orWhere('thread', 'like', "%{$request->search_query}%");
        $hits = $threads->count();
        $threads = $threads->get();

        return response()->json(['course' => $course, 'threads' => $threads, 'hits' => $hits], 200);
    }
}
