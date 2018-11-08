<?php

namespace App\Http\Controllers\Courses;

use App\Models\Comments\Comments;
use App\Models\Course\Course;
use App\Models\Threads\Threads;
use App\Models\Views\Views;
use App\Traits\RecalibratesCourseRatings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    use RecalibratesCourseRatings;

    /**
     * Display the specified course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        Views::create([
            'user_id' => (Auth::check()) ? Auth::id() : null,
            'view_medium' => 'web',
            'viewable_type' => Course::class,
            'viewable_id' => $course->id
        ]);

        return view('courses.course_profile', compact('course'));
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

        return view('courses.forum.course_forum', compact('course', 'topics','threads', 'topics'));
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
            'comment_body' => 'required|string|max:1200'
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('error', $validator->errors());
        }

        $course = Course::findOrFail($course_id);

        $comment = new Comments();
        $comment->user_id = auth()->id();
        $comment->body = $request->comment_body;

        $course->comments()->save($comment);

        $this->recalibrateCourseRating($course, $comment);

        return back()->with('success','Comment added successfully');

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

        return view('courses.forum.thread.course_thread', compact('thread', 'course'));
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
            return back()->withErrors($validator)->withInput()->with('error', $validator->errors());
        }

        $thread = Threads::findOrFail($thread_id);

        $comment = new Comments();
        $comment->user_id = auth()->id();
        $comment->body = $request->comment_body;

        $thread->comments()->save($comment);

        return back()->with('success','Comment created successfully');

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
            return back()->withErrors($validator)->withInput()->with('error', $validator->errors());
        }

        $course = Course::findOrFail($request->course_id);

        $threads = $course->threads()->where('subject', 'like', "%{$request->search_query}%")->orWhere('thread', 'like', "%{$request->search_query}%");
        $hits = $threads->count();
        $threads = $threads->get();


        return view('courses.forum.course_forum_search', compact('threads', 'course', 'hits'));

    }
}
