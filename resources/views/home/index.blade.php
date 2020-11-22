@extends('layouts.home')
@section('content')

<div class="col-md-6">
	<div class="card">
		<div class="card-body">
			<h3><a href="#">Anasayfa</a></h3>
			<hr>
			<div class="row">
				<div class="col-sm-3">
					<center>
					@if(Auth::user()->image =='')
					<img class="rounded-circle" width="100%" src="https://www.searchpng.com/wp-content/uploads/2019/02/Men-Profile-Image.png">
					@else
					<img class="rounded-circle" width="100%" src="{{asset(Auth::user()->image)}}">
					@endif
					<b>{{Auth::user()->name}}</b>
					</center>
				</div>
				<div class="col-sm-9">
			<form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<textarea rows="5" name="content" class="form-control" placeholder="What do you think ?"></textarea>
					@error('content')
					<p class="text-danger">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-group">
					<label>Image</label>
					<input type="file" name="image">
					@error('image')
					<p class="text-danger">{{ $message }}</p>
					@enderror
				</div>
				<button class="btn btn-block btn-primary">Post</button>
			</form>
				</div>
			</div>
		</div>
	</div>
	<br>
@include('post.box')
</div>
@include('search.script')
@endsection