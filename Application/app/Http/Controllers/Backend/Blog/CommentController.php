<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('article_id')) {
            $comments = BlogComment::where('article_id', $request->article_id)->with(['user', 'blogArticle'])->get();
        } else {
            $comments = BlogComment::with(['user', 'blogArticle'])->get();
        }
        return view('backend.blog.comments.index', ['comments' => $comments]);
    }

    public function viewComment($id)
    {
        $comment = BlogComment::find($id);
        if (!$comment) {
            return response()->json(['error' => 'Comment not exists']);
        }
        return response()->json([
            'success' => true,
            'comment' => $comment->comment,
            'publish_link' => route('comments.update', $comment->id),
            'delete_link' => route('comments.destroy', $comment->id),
            'status' => $comment->status,
        ]);
    }

    public function updateComment(Request $request, $id)
    {
        $comment = BlogComment::find($id);
        if (!$comment) {
            toastr()->error(__('Comment not exists'));
            return back();
        }

        if ($comment->status) {
            toastr()->info(__('Comment already published'));
            return back();
        }

        $comment->update(['status' => true]);
        toastr()->success(__('Published Successfully'));
        return back();
    }

    public function destroy($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->delete();
        toastr()->success(__('Deleted Successfully'));
        return back();
    }
}
