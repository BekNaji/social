
@extends('layouts.home')

{{-- profile compnents --}}
@section('content')
<div class="col-md-6">
<div class="card">
		<div class="card-body">
			<a href="{{route('profile',[$user->id,$user->name])}}"><b>Back</b></a><hr>
			<div class="row">
				<div class="col-sm-3">
					@if($user->image != '')
<img style="height:80px;" class="img-fluid img-circle" src="{{asset($user->image)}}">
					@else
					<img style="height:80px;" class="img-fluid img-circle" src="https://www.searchpng.com/wp-content/uploads/2019/02/Men-Profile-Image.png">
					@endif
				</div>
				<div class="col-sm-9 border-left">
					
					<form enctype="multipart/form-data" action="{{route('profile.update')}}" method="POST">
						@csrf
						<div class="form-group">
							<label>Full Name</label>
							<input value="{{$user->name}}" type="text" name="name" class="form-control">
							@error('name')
								<p class="text-danger">{{$message}}</p>
							@enderror
						</div>
						<div class="form-group">
							<label>Your Picture</label>
							<input type="file" name="image" class="form-control">
							@error('image')
								<p class="text-danger">{{$message}}</p>
							@enderror
						</div>
						<div class="form-group">
							<label>Data of Birth</label>
							<input 
							type="date" 
							name="date_of_birth" 
							class="form-control"
							value="{{$user->date_of_birth ?? ''}}" 
							>
							@error('date_of_birth')
								<p class="text-danger">{{$message}}</p>
							@enderror
						</div>
						<div class="form-group">
							<label>Email</label>
							<input value="{{$user->email}}" type="email" name="email" class="form-control">
							@error('email')
								<p class="text-danger">{{$message}}</p>
							@enderror
						</div>
						<div class="form-group">
							<label>Password <br>( If you pass blank the password will not change )</label>
							<input type="password" name="password" class="form-control">
							@error('password')
								<p class="text-danger">{{$message}}</p>
							@enderror
						</div>
						<div class="form-group">
							<label>About Me</label>
							<textarea name="about_me" rows="5" class="form-control">{{$user->about_me ?? ''}}</textarea>
							@error('about_me')
								<p class="text-danger">{{$message}}</p>
							@enderror
						</div>
						<button type="submit" class="btn btn-primary">Update</button>


					</form>
					
				</div>
			</div>
		</div>
	</div>
	<br>
	
</div>

@endsection