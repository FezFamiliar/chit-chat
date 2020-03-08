@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Your Profile: </h2>

				<div class="media">
					<a href="" class="pull-left">
							<img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mm" alt="palceholder" class="media-object">
					</a>
		    	<div class="media-body">
					<h4 class="media-heading"><a href=""> {{ Auth::user()->name }}</a></h4>
					<p>{{ Auth::user()->location }}</p>
				</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="mb-5"><h2>Update Your Profile</h2></div>
				<form method="POST" action="" autocomplete="off">
					<div class="form-group">
						<label>Name:</label>
						<input type="text" name="name" class="form-control">
					</div>
					<div class="form-group">
						<label>Location:</label>
						<input type="text" name="location"  class="form-control">
					</div>
					<input type="submit" class="btn btn-outline-secondary" value="Update">
				</form>	
			</div>
		</div>
	</div>
@endsection