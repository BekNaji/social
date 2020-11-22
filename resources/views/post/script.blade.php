<script>

$(document).ready(function()
{

	 
	// remove post
	$(document).on('click','#removePost',function()
	{
		var id = $(this).data('id');
		var removeId = $('#removeId').val(id);
		
	});

	// liked
	$(document).on('click','.rating',function	() 
	{
		var id 		= $(this).data('id');
		var type 	= $(this).data('type');
		
		$.ajax({
			type:'GET',
			url:'{{route('post.rating')}}',
			data: { id:id,type:type },
			success:function(message)
			{
				postRatingCount(id);
				if(message !='')
				{
					if(message === 'like')
					{
						$('.likes'+id).removeClass('text-danger');
						$('.likes'+id).addClass('text-success');
						$('.likes'+id).text('You Liked');
					}
					if(message === 'dislike')
					{
						$('.likes'+id).removeClass('text-success');
						$('.likes'+id).addClass('text-danger');
						$('.likes'+id).text('You Disliked');
					}
				}
				else
				{
					$('.likes'+id).text('');
				}
				
				


			}
		});
	});

	// get post rating Count
	function postRatingCount(id)
	{
		$.ajax({
			type:'GET',
			url:'{{ route('post.rating.count') }}',
			data: { id: id },
			success:function(message)
			{	
				var m = $.parseJSON(message);
				$('#likeCount'+id).text(m.like);
				$('#dislikeCount'+id).text(m.dislike);
			}
		});
	}


});
</script>