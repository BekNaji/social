<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Stream;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $streams = $this->getStreams();
        

        return view('home.index',compact('streams'));
    }

    public function getStreams()
    {
        $streams = Stream::orderBy('id','desc')->get();

        return $streams;


    }


}
