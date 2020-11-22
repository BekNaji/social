<script>

$(document).ready(function()
{

	// show remove comment  modal
	$(document).on('click','.commentRemove',function()
	{
		var id = $(this).data(id);
		$('#commentRemoveId').val(id.id);
		$('#removeCommentModal').modal('show');

	});

	// show edit comment modal
	$(document).on('click','.commentEdit',function()
	{
		var id = $(this).data(id);
		
		getComment(id.id);

	});

	// edit comment  Form
 	$(document).on('submit','#commentEditForm',function(e)
	{
		e.preventDefault();
		var data = $(this).serialize();
		$('.updateComment').html('<span class="spinner-border spinner-border-sm"></span>');
		$.ajax({
			type:"POST",
			url:"{{route('comment.update')}}",
			data:data,
			success:function(message)
			{

				getComments(message);
				$('#editCommentModal').modal('hide');
				$('.updateComment').text('Update');
			}
		})
	});

	
	// remove comment 
	$(document).on('submit','#commentRemoveForm',function(e)
	{
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			type:"POST",
			url:"{{route('comment.remove')}}",
			data:data,
			success:function(message)
			{
				getComments(message);
				
				$('#removeCommentModal').modal('hide');
			}
		})
	})

	// function of get a comment
	function getComment(id)
	{

		$.ajax({
			type:'GET',
			url:'{{ route('get.comment') }}',
			data: {id:id},
			success:function(message)
			{	

				$('#commentEditId').val(message.id);
				$('#commentEditContent').val(message.content);
				$('#editCommentModal').modal('show');
				
			}
		});
	}

	function getCommentCount(id)
	{
		$.ajax({
			type:'GET',
			url:'{{route("comment.count")}}',
			data:{id:id},
			success:function(data)
			{
				$('#commentCount'+id).text(data);
			}
		})
	}


	// store comment
	$(document).on('submit','#storeComment',function(e)
	{
		var data = $(this).serialize();
		$('.storeComment').html('<span class="spinner-border spinner-border-sm"></span>');
		e.preventDefault();
		$.ajax({
			type:"POST",
			url:'{{route('comment.store')}}',
			data: data,
			success:function(message)
			{
				getComments(message.post_id);
				$('.storeComment').text('Comment');
				$('#storeComment')[0].reset();
			}
		})
	});
	 
	
	// get comments of post
	$(document).on('click','#getComments',function(e)
	{
		var id = $(this).data('id');
		getComments(id);
	});
	

	// function of get comment
	function getComments(id)
	{
		$.ajax({
			type:'GET',
			url:'{{ route('get.comments') }}',
			data: {id:id},
			success:function(message)
			{	
				getCommentCount(id);
				$('#comment'+id).html('');
				$('#comment'+id).html(message);
				
			}
		});
	}

});
</script>