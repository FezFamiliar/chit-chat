@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-5">
			@include('inc.userblock')
			<hr>
		</div>
		<div class="offset-lg-3 col-lg-4">
			<h4>{{ $user->name }}'s friends</h4>


 			@if(!$user->friends()->count())
				<p>{{ $user->name }} has no friends.</p>

			@else
				@foreach($user->friends() as $user)
					@include('inc.userblock')
				@endforeach
			@endif 
		</div>
	</div>
</div>
@endsection
