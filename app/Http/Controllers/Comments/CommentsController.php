<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comments\Comments;
use App\Models\Course\Course;
use App\Traits\RecalibratesCourseRatings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    use RecalibratesCourseRatings;
    /**
     * Add a comment to the DB
     *
     * @param Request $request
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addCommentComment(Request $request, $comment_id, $course_id = null)
    {
        $comment = Comments::findOrFail($comment_id);

        $this->validate($request, [
            'comment_body' => 'required|string|max:180'
        ]);

        $new_comment = new Comments();
        $new_comment->body = $request->comment_body;
        $new_comment->commentable_type = Comments::class;
        $new_comment->commentable_id = $comment->id;

        $comment->comments()->save($new_comment);

        if ($course_id != null){
            $course = Course::findOrFail($course_id);
            $this->recalibrateCourseRating($course, $comment);
        }

        return back()->with('success','Comment created successfully');
    }

}
