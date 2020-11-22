@extends('layouts.home')
@section('content')
<div class="col-md-6">
	<!-- post started -->
	<div class="card" id="post">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<a href="{{route('home')}}">Back</a><hr>
					<form action="{{ route('post.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="id" value="{{$post->id}}">
					@if($post->image)
					<center>
					<img  style="max-width:430px;" class="img-fluid"
					src="{{asset($post->image ?? '')}}">
					</center><br>
					@endif
					<div class="form-group">
						<label>Image</label>
						<input type="file" name="image">
					</div>

					<div class="form-group">
						<label>Content</label>
						<textarea rows="15" name="content" class="form-control">{{ $post->content }}</textarea>
					</div>
					<button type="submit" class="btn btn-primary">Update</button>
					
					</form>
					
				</div>
				
			</div>
		</div>
	</div>
	<!-- post finished -->
</div>

@endsection