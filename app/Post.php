<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Post extends Model
{
    protected $table = 'post';

    // get user data
    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }

    // get like count
    public static function likeCount($post)
    {
    	$like = Like::where('post_id','=',$post)->where('type','=','like')->get();

    	if($like)
    	{
    		return $like->count();
    	}

    	return 0;
    }

    // get dislike count
    public static function disLikeCount($post)
    {
    	$dislike = Like::where('post_id','=',$post)->where('type','=','dislike')->get();

    	if($dislike)
    	{
    		return $dislike->count();
    	}

    	return 0;
    }

    // relation comment
    public function comments()
    {
    	return $this->hasMany('App\Comment','post_id','id');
    }

    // get comment count of post
    public static function commentCount($id)
    {
        $comment = Comment::where('post_id','=',$id)->get();
        return $comment->count();
    }


}
