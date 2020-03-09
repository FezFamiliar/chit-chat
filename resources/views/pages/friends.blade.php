@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h3>Your Friends</h3>
				@if(!Auth::user()->friends()->count())
					<p>you have no friends.</p>

				@else
					@foreach(Auth::user()->friends() as $user)
						@include('inc.userblock')
					@endforeach
				@endif 
			</div>
			<div class="col-md-6">
				<h4>Friend Requests</h4>
			</div>
		</div>
	</div>
@endsection