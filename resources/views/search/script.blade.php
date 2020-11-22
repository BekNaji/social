<script>
$(document).ready(function()
{
	$(document).on('keyup','#search',function()
	{
		$.ajax({
			url:'{{ route('search') }}',
			type:'GET',
			data:{data: $(this).val()},
			success:function(message)
			{
				$('#search_result').html(message);
			}
		})
	})
});

</script>