<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;
use App\Stream;
class ProfileController extends Controller
{
	// this function show user page to user
    public function index(Request $request)
    {
    	$user = User::find($request->id);

    	$streams = Stream::where('user_id','=',$user->id)->get();
    	
    	return view('profile.index',compact('user','streams'));
    }

    // this function show edit page to user
    public function edit(Request $request)
    {
    	if($request->id != Auth::user()->id)
    	{
    		abort('404');
    	}
    	$user = User::find($request->id);

    	return view('profile.edit',compact('user'));
    }

    // this function update user info
    public function update(Request $request)
    {
    	$request->validate([
            'name' => 'required|max:255',
            'email'=> 'required|email',
            'about_me' => 'required|max:500',
            'date_of_birth'=>'required'
        ]);
   
    	$user = User::find(Auth::user()->id);
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->date_of_birth = $request->date_of_birth;
    	$user->about_me = $request->about_me;
    	if($request->password != '')
    	{
			$request->validate([
				'password'=>'max:255'
			]);
    		$user->password = encrypt($request->password);
    	}
    	if($request->image !='')
    	{

    		$request->validate([
				'image'=>'mimes:png,jpg,jpeg'
			]);
			// get real extension and give random name
			$image = time().'.'.$request->image->extension();

			// move to public folder 
			$file = $request->image->move(public_path('images'),$image);

			// get real name of file to give database
			$imageName = 'images/'.$image;

			// store real name to database
			$user->image = $imageName; 
    	
    	}

    	$user->save();

    	return back()->with(['success'=>'Updated']);


    }


}
