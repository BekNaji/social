<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;
use Auth;


class Like extends Model
{
    protected $table = 'like';

    public static function userDisliked($user_id,$post_id)
    {
        $has_user_id = Like::where('user_id','=',$user_id)
        ->where('post_id','=',$post_id)->get()->first();

        if($has_user_id)
        {
            if($has_user_id->type == 'dislike' )
            {
                return true;
            }
        }

        return false;
    }

    public static function userLiked($user_id,$post_id)
    {
        $has_user_id = Like::where('user_id','=',$user_id)
        ->where('post_id','=',$post_id)->get()->first();
   
        if($has_user_id)
        {
            if($has_user_id->type == 'like')
            {
                return true;
            }
        }

        return false;
    }

   
}
