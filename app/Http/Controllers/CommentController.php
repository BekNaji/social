<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    
    public function store(Request $request)
    {
    	$request->validate([
            'comment_content' => 'required|max:500',
        ]);
    	$comment = new Comment();
    	$comment->content = $request->comment_content;
    	$comment->post_id = $request->post_id;
    	$comment->user_id = Auth::user()->id;
        $comment->user_name = Auth::user()->name;
    	$comment->save();

    	return $comment;
    }

    public function update(Request $request)
    {
        $request->validate([
            'comment_edit_content' => 'required|max:500',
        ]);
        $comment = Comment::find($request->id);
        $post_id = $comment->post_id;
        $comment->content = $request->comment_edit_content;
        $comment->save();

        return $post_id;
    }

    public function getComments(Request $request)
    {
        
        $comments = Comment::where('post_id','=',$request->id)->orderBy('id','desc')->get();
        $data = '';
        foreach ($comments as $comment) 
        {
            $data .='
            <div style="border-radius: 20px;" class="card">
            <div class="card-body">
            <a href="'.route("profile",[$comment->user_id,$comment->user_name]).'">
            '.$comment->user_name.'</a><hr>
            <p>'.$comment->content.'</p>';

            if($comment->user_id == Auth::user()->id)
            {
                $data .= '
                <a class="commentEdit" id="commentEdit'.$comment->id.'" 
                data-id="'.$comment->id.'" data-post_id="'.$comment->post_id.'"
                href="javascript:void(0)">Edit</a> |
                <a class="commentRemove" id="commentRemove'.$comment->id.'" 
                data-id="'.$comment->id.'" data-post_id="'.$comment->post_id.'"
                href="javascript:void(0)">Delete</a> |';
            }

            $data .= ' 
            <i> '.$comment->created_at.'</i></div></div><br>';
        }
        return $data;
    }

    public function commentCount(Request $request)
    {
        $comments = Comment::where('post_id','=',$request->id)->get();
        return $comments->count();
    }

    public function getComment(Request $request)
    {
        $comment = Comment::find($request->id);
        return $comment;
    }

    public function remove(Request $request)
    {
        $comment = Comment::find($request->id);
        $post_id = $comment->post_id;
        $comment->delete();
        return $post_id;
    }
}
