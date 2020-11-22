<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use File;
use App\Like;
use App\Stream;

class PostController extends Controller
{
	// store post
    public function store(Request $request)
    {
    	$request->validate([
    		'content' => 'required|max:2000',
    		'image' => 'mimes:jpg,jpeg,png'
    	]);

    	$post = new Post();


    	$post->content = $request->content;
    	$post->user_id = Auth::user()->id;

    	if($request->image != '')
    	{
			// get real extension and give random name
			$image = time().'.'.$request->image->extension();

			// move to public folder 
			$file = $request->image->move(public_path('images'),$image);

			// get real name of file to give database
			$imageName = 'images/'.$image;

			// store real name to database
			$post->image = $imageName; 
    	}
    	$post->save();
        $stream = new Stream();
        $stream->user_id = Auth::user()->id;
        $stream->post_id = $post->id;
        $stream->type = "Published";
        $stream->save();

    	return back();
    }

    // update post
    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|max:2000',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $post = Post::find($request->id);

        $post->content = $request->content;

        if($request->file('image') != '')
        {   
            $image_path  = $post->image;

            if(file_exists($image_path))
            {
                @unlink($image_path);
            }
            // get real extension and give random name
            $image = time().'.'.$request->image->extension();

            // move to public folder 
            $file = $request->image->move(public_path('images'),$image);

            // get real name of file to give database
            $imageName = 'images/'.$image;

            // store real name to database
            $post->image = $imageName; 
        }
        $post->save();

        return redirect()->route('home')->with(['success' => 'Updated']);
    }

    // edit post
    public function edit(Request $request)
    {
        $post = Post::find(decrypt($request->id));

        return view('post.edit',compact('post'));
    }

    // edit post
    public function show(Request $request)
    {
        $post = Post::find(decrypt($request->id));

        return view('post.show',compact('post'));
    }

    // remove image
    public function remove(Request $request)
    {
        $post = Post::find($request->id);

        $image_path  = $post->image;

        // remove file
        if(file_exists($image_path))
        {
            @unlink($image_path);
        }
        $post->delete();

        return back()->with(['success'=>'Post Deleted']);
    }

    public function rating(Request $request)
    {
        // get like and dislike data 
        $like = Like::where('user_id','=',Auth::user()->id)
        ->where('post_id','=',$request->id)->get()->first();
        
        // if has rating of user and rating type equal to request type data will delete
        if($like && $like->type == $request->type)
        {
            $like->delete();
            return false; 
        }
        // if has not rating of user, it will create new data    
        if(!$like)
        {
            $like = new Like(); 
            
        }    

        // here some store and update data
        $like->user_id  = Auth::user()->id;
        $like->post_id  = $request->id;
        $like->type     = $request->type;
        $like->save();

        return $request->type;

 
    }

    public function postRatingCount(Request $request)
    {
        $rating['like']     = Post::likeCount($request->id);
        $rating['dislike']  = Post::dislikeCount($request->id);

        return json_encode($rating);
    }


}
