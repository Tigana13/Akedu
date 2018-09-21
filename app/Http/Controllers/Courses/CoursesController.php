<?php

namespace App\Http\Controllers\Courses;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.course_profile', compact('course'));
    }


    public function showForum($id)
    {
        $course = Course::findOrFail($id);
        $threads = $course->threads;
        $topics = $course->topics;

        return view('courses.forum.course_forum', compact('course', 'topics','threads', 'topics'));
    }


    public function addCourseComment(Request $request, $course_id)
    {
        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string|max:180'
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('error', $validator->errors());
        }

        $course = Course::findOrFail($course_id);

        $comment = new Comments();
        $comment->user_id = auth()->id();
        $comment->body = $request->comment_body;

        $course->comments()->save($comment);

        return back()->with('success','Comment added successfully');

    }

    public function createCourseThread(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thread_subject' => 'required|string|max:180',
            'thread_title' => 'required|string|max:180',
            'course_id' => 'required|integer'
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('error', $validator->errors());
        }

        $course = Course::findOrFail($request->course_id);

        $thread = new Threads();
        $thread->thread = $request->thread_title;
        $thread->subject = $request->thread_subject;
        $thread->threadable_type = Course::class;
        $thread->threadable_id = $course->id;

        $course->threads()->save($thread);

        return redirect(route('course.thread.show', ['course_id' => $course->id, 'thread_id' => $thread->id]));

    }


    public function showCourseThread($course_id, $thread_id)
    {
        $thread = Threads::findOrFail($thread_id);

        $course = Course::findOrFail($course_id);

        return view('courses.forum.thread.course_thread', compact('thread', 'course'));
    }

    public function addThreadComment(Request $request, $thread_id)
    {

        $validator = Validator::make($request->all(), [
            'comment_body' => 'required|string|max:180'
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('error', $validator->errors());
        }

        $thread = Threads::findOrFail($thread_id);

        $comment = new Comments();
        $comment->user_id = auth()->id();
        $comment->body = $request->comment_body;

        $thread->comments()->save($comment);

        return back()->with('success','Comment created successfully');

    }

    public function searchThreads(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
            'search_query' => 'required|string|max:200'
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('error', $validator->errors());
        }

        $course = Course::findOrFail($request->course_id);

        $threads = $course->threads()->where('subject', 'like', "%{$request->search_query}%")->orWhere('thread', 'like', "%{$request->search_query}%");
        $hits = $threads->count();
        $threads = $threads->get();


        return view('courses.forum.course_forum_search', compact('threads', 'course', 'hits'));

    }
}
