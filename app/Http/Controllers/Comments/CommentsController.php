<?php

namespace App\Http\Controllers\Comments;

use App\Models\Comments\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

    /**
     * Add a comment to the DB
     *
     * @param Request $request
     * @param $comment_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCommentComment(Request $request, $comment_id)
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

        return back()->with('success','Comment created successfully');
    }

}
