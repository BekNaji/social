@extends('layouts.home')
@section('content')
<div class="col-md-6">
	<!-- post started -->
	<div class="card" id="post">
		<div class="card-body">
			<a onclick="history.back()" href="#back"><b>Back</b></a><hr>
			@if($post->image)
			<center>
			<img  style="max-width:430px;" class="img-fluid"
			src="{{asset($post->image ?? '')}}">
			</center>
			@endif
			<br><br>
			<p>{{ $post->content }}</p>
			<h3>Comments</h3><hr>
			<center>
			<b><a href="javascript:void(0)" data-id="{{$post->id}}" id="getComments" >Load Comments</a></b>
			</center>
			<div class="card-header">
						<form id="storeComment">
							@csrf
							<input type="hidden" name="post_id" value="{{$post->id}}">
							<textarea name="comment_content" class="form-control " placeholder="Write Comment" required></textarea>
							@error('comment_content')
							<p class="text-danger">{{ $message }}</p>
							@enderror
							<br>
							<button  class="btn btn-primary storeComment">Comment</button>
						</form>
					</div>
					<div id="comment{{$post->id}}" class="card-header comment" >
					</div>
			
		</div>
	</div>
	<br>
	<!-- post finished -->
</div>
@include('comment.box')
@endsection