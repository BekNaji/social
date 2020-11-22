@foreach($streams as $post)
<!-- post started -->
<div class="card" id="post">
	<div class="card-body">
		{{-- header of post box --}}
		<div class="row">
			<div class="col-md-3">
				@if($post->user->image == null)
				<img class="rounded-circle" width="100%" src="https://www.searchpng.com/wp-content/uploads/2019/02/Men-Profile-Image.png">
				@else
				<img class="rounded-circle" width="100%" src="{{asset($post->user->image)}}">
				@endif
			</div>
			<div class="col-md-6">
				<h4><a href="{{route('profile',[$post->user_id,$post->user->name])}}">{{ $post->user->name }}</a></h4>
				@if($post->user_id == Auth::user()->id)
				<b>You</b>
				@else
				<b>{{$post->user->name }}</b>
				@endif
				{{$post->type ?? ''}}
			</div>
			<div class="col-md-2">
			
				@if($post->user_id == Auth::user()->id)
				<div class="dropdown">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					Options
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item"
						href="{{route('post.edit',encrypt($post->post->id))}}">Edit</a>
						<a id="removePost"
						data-id='{{ $post->post->id }}' data-toggle="modal" data-target="#removePostModal"  class="dropdown-item text-danger" href="#">Delete</a>
					</div>
				</div>
				@endif
			</div>
		</div>
		{{-- finished header of post box --}}
		<hr>
		{{-- content of post box --}}
		<div class="row">
			<div class="col-md-12">
				<p id="content-text">{{ $post->post->content }}</p>
				@if($post->post->image)
				<center>
				<img style="width: 100%" class="img-fluid"
				src="{{asset($post->post->image)}}">
				</center><br>
				@endif
				
				
				<p><i>{{ $post->created_at }}</i></p>
			</div>
			<hr>

			<div class="col-md-4" id="ratings{{$post->post->id}}">
				<button
				data-id="{{$post->post->id}}"
				data-type="like"
				id="like{{$post->post->id}}" class="rating btn btn-info"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
				<span
					id="likeCount{{$post->post->id}}" class="badge badge-light">
					{{ App\Post::likeCount($post->post->id) }}
				</span>
				</button>
				
				<button
				data-id="{{$post->post->id}}"
				data-type="dislike"
				id="dislike{{$post->post->id}}" class="rating btn btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i>
				<span id="dislikeCount{{$post->post->id}}" class="badge badge-light ">
					{{ App\Post::dislikeCount($post->post->id) }}
				</span>
				</button>
				@if(App\Like::userLiked(Auth::user()->id,$post->post->id))
				<p class="text-success likes{{$post->post->id}}">You liked</p>
				@elseif(App\Like::userDisliked(Auth::user()->id,$post->post->id))
				<p class="text-danger likes{{$post->post->id}}">You disliked</p>
				@else
				<p  class="text-danger likes{{$post->post->id}}"></p>
				@endif


				
			</div>

			<div class="col-md-5">
				<a  data-id="{{$post->post->id}}" 
					id="getComments" 
					href="#" 
					data-toggle="collapse" 
					data-target="#comments{{$post->post->id}}">Comment: 
					<span id="commentCount{{$post->post->id}}">
						{{App\Post::commentCount($post->post->id)}}
					</span></a>
			</div>
			<div class="col-md-3">
				<a href="{{route('post.show',encrypt($post->post->id))}}">Read More</a>
			</div>
			{{-- comment box included --}}
			<div class="col-md-12">
				<br>
				<div id="comments{{$post->post->id}}" class="card collapse">
					<div class="card-header">
						<form id="storeComment">
							@csrf
							<input type="hidden" name="post_id" value="{{$post->post->id}}">
							<textarea name="comment_content" class="form-control " placeholder="Write Comment" required></textarea>
							@error('comment_content')
							<p class="text-danger">{{ $message }}</p>
							@enderror
							<br>
							<button  class="btn btn-primary storeComment">Comment</button>
						</form>
					</div>
					<div id="comment{{$post->post->id}}" class="card-header comment" >
					</div>
					
					
				</div>
			</div>
			
		</div>
		{{-- finished content of box --}}
	</div>
</div>
<!-- post finished -->
<br>
@endforeach
@include('comment.box')
{{-- modal included --}}
@include('post.removePostModal')
{{-- script included --}}
@include('post.script')