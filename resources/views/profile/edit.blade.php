@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="mb-5"><h2>Update Your Profile</h2></div>
				@include('inc.flash')
				<form method="POST" action="{{ route('profile.edit') }}" autocomplete="off" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<img class="media-object" src="{{ asset('img\\') . Auth::user()->profile}}" alt="placeholder" height="80" width="80">
						<input type="file" name="profile-pic">
					</div>
					<div class="form-group"> 
						@if ($errors->has('name'))
						    <div class="alert alert-danger">
						                {{ $errors->first('name') }}
						    </div>
						@endif
						<label>Name:</label>
						<input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">

					</div>
					<div class="form-group">
						@if ($errors->has('location'))
						    <div class="alert alert-danger">
						                {{ $errors->first('location') }}
						    </div>
						@endif
						<label>Location:</label>
						<input type="text" name="location"  class="form-control" value="{{ Auth::user()->location }}">

					</div>
					<input type="submit" class="btn btn-outline-secondary" value="Update">
				</form>	
			</div>
		</div>
	</div>
@endsection