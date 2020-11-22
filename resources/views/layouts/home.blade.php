<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Social Test</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
		
		<style type="text/css">
			body {
				font-size: 14px;
				background-color: #F0F8FF;
			}
			#post #content-text {
				
				max-height: 100px;
				overflow: hidden;
				text-overflow: ellipsis;
				
			}
			.comment {
				max-height: 400px;
				overflow-y:scroll
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				{{-- menu --}}
				<div class="col-3">
					<ul class="list-group position-fixed" style="width:19%;">
						<li class="list-group-item"><h3><a href="#">Logo</a></h3></li>
						<li class="list-group-item"><a
							href="
							{{route('profile',[Auth::user()->id,Auth::user()->name])}}">
						Profile</a></li>
					</ul>
				</div>
				<!-- Post akis sayfa -->
				@yield('content')
				<div class="col-md-3">
					<div class="card position-fixed">
						<div class="card-body">
							<form action="{{route('search.result')}}" method="GET">
								<div class="input-group mb-3">
									<input name="key" id="search" type="text" class="form-control" placeholder="Search">
									<div class="input-group-append">
										<button  class="btn btn-primary " type="submit">Go</button>
									</div>
								</div>
							</form>
						</div>
						<div id="search_result"></div>
					</div>
					
				</div>
			</div>
			
		</div>
		<script type="text/javascript">
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
		<br><br><br>
	</body>
</html>