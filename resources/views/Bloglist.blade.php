<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="{{ asset('css/bloglist.css') }}" rel="stylesheet">

<body>
  
<div class="container">
	<div class="row">

		<section class="content">
			<h1>Blog Posts</h1>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
				
									@if(count($allblogs) == 0)
										<h1>No Post Found</h1>
										@endif
						<div class="table-container">
							<table class="table table-filter">
								<tbody>

    
                @foreach($allblogs as $blog)  
									<tr data-status="pagado">
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													
                          <img src="{{ asset($blog->blog_image) }}" width="70px" height="70px" alt="Image">
												</a>
												<div class="media-body">
													<span class="media-meta pull-right">{{ \Carbon\Carbon::parse($blog->blog_date)->toDayDateTimeString()}}
                            
                          </span>
													<h4 class="title">
														{{$blog->title}}
														<span class="pull-right pagado">(sneha)</span>
													</h4>
													<p class="summary">{{$blog->blog}}</p>
												</div>
											</div>
										</td>
									</tr>
                  @endforeach


								</tbody>
							</table>
             
						</div>
					</div>
          
				</div>
        {!! $allblogs->links() !!}
			</div>
      
		</section>

   
		
	</div>
</div>




</body>
