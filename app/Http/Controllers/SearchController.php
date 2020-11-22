<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Stream;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$data = '';

    	if($request->data !='')
    	{
			$users = User::where('name','like','%'.$request->data.'%')->get();

			foreach ($users as $key => $user) 
			{
				$data .= 
				'<ul class="list-group">
				<li class="list-group-item">
				<a href="'.route("profile",[$user->id,$user->name]).'">'.$user->name.'</a></li>
				</ul>';
			}

    	}
    	return $data;
    }

    public function result(Request $request)
    {
    	$users = User::where('name','like','%'.$request->key.'%')->get();

    	return view('search.box',compact('users'));
    }
}
