@extends('layouts.app')

@section('content')
<div class="container">
	@include('inc.flash')
	<div class="row">

		<div class="col-lg-5">
			@include('inc.userblock')

			<hr>
		</div>
		<div class="offset-lg-3 col-lg-4">

			@if(Auth::user()->hasFriendReqPending($user)) 

				<p>	Waiting for {{ $user->name }} to accept your friend request</p>
			@elseif(Auth::user()->hasFriendReqReceived($user))
				<a href="{{ route('accepted.friend',['username' => $user->name]) }}" class="btn btn-primary">Accept friend request</a>
				{{-- <a href="" class="btn btn-danger">Ignore</a> --}}
			@elseif(Auth::user()->isFriendsWith($user))
					<p>	You and {{ $user->name }} are friends</p>
			@elseif(Auth::user()->id !== $user->id)
					<a href="{{ route('add.as.friend',['username' => $user->name]) }}" class="btn btn-primary">Add as friend</a>
			@endif

			@if(Request::is('user/' . Auth::user()->name))
				<h4>Your friends</h4> 
		 	@else
				<h4>{{ $user->name }}'s friends</h4> 
			@endif 
		
 			@if(!$user->friends()->count())
	 			@if(Request::is('user/' . Auth::user()->name))
					<p>You have no friends</p> 
			 	@else
					<p>{{ $user->name }} has no friends.</p>
				@endif
			@else
				@foreach($user->friends() as $user)
					@include('inc.userblock')
				@endforeach
			@endif 
		</div>
	</div>
</div>
@endsection
