<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';


    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }
}
