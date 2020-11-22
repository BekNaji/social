@extends('layouts.home')
@section('content')


<div class="col-md-6">
	<div class="card">
		<div class="card-body">
			<a href="{{route('home')}}"><b>Home</b></a><hr>
			<div class="row">
				<div class="col-sm-3">
					@if($user->image == null)
					<img class="rounded-circle" width="100%" src="https://www.searchpng.com/wp-content/uploads/2019/02/Men-Profile-Image.png">
					@else
					<img class="rounded-circle" width="100%" src="{{asset($user->image)}}">
					@endif
				</div>
				<div class="col-sm-9 border-left">
					<div class="row">
						<div class="col-sm-8">
							<h3>{{$user->name}}</h3>
						</div>
						<div class="col-4">
							
							@if($user->id == Auth::user()->id)
							<a 
				href="{{route('profile.edit',[Auth::user()->id,Auth::user()->name])}}" class="btn btn-primary">Edit</a>
							@endif
						</div>
					</div>
					<hr>
					<b>About</b>
					<p>{{$user->about_me??''}}</p>
				</div>
			</div>
		</div>
	</div>
	<br>
	@include('post.box')
</div>

@endsection