@extends('layouts.home')
@section('content')


<div class="col-md-6">
	@foreach($users as $user)
	<div class="card">
		<div class="card-body">
			<a href="{{route('home')}}"><b>Home</b></a><hr>
			<div class="row">
			<div class="col-md-3">
				@if($user->image == null)
				<img class="rounded-circle" width="100%" src="https://www.searchpng.com/wp-content/uploads/2019/02/Men-Profile-Image.png">
				@else
				<img class="rounded-circle" width="100%" src="{{asset($user->image)}}">
				@endif
			</div>
			<div class="col-md-6">
				<h4><a href="{{route('profile',[$user->id,$user->name])}}">{{ $user->name }}</a></h4>
			</div>
			<div class="col-md-2">
			
			</div>
		</div>
		</div>
	</div>
	<br>
	@endforeach
</div>

@endsection