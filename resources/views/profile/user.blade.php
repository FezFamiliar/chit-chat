@extends('layouts.app')

@section('content')
<div class="container">
	@include('inc.flash')
	<div class="row">
		<div class="col-lg-5">
			@if(Auth::user()->hasFriendReqPending($user)) 
				<p>	Waiting for {{ $user->name }} to accept your friend request.</p>
			@elseif(Auth::user()->hasFriendReqReceived($user))
				<a href="{{ route('ignore.friend',['username' => $user->name]) }}" class="btn btn-secondary float-right">Ignore</a> 
				<a href="{{ route('accepted.friend',['username' => $user->name]) }}" class="btn btn-primary float-right mr-2">Accept Friend Request</a>  
			@elseif(Auth::user()->isFriendsWith($user))
					<span>	You and {{ $user->name }} are friends.</span>
					<a href="{{ route('unfriend.friend',['username' => $user->name]) }}" class="btn btn-secondary float-right">Unfriend {{ $user->name }}</a>
			@elseif(Auth::user()->id !== $user->id)
					<a href="{{ route('add.as.friend',['username' => $user->name]) }}" class="btn btn-primary float-right">Add as friend</a>
			@endif
			@include('inc.userblock')
			<hr>
		</div>
		<div class="offset-lg-2 col-lg-5">

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
					@if($user->id !== Auth::user()->id)
 						@if(Auth::user()->isFriendsWith($user) && Request::url() != 'http://chitchat.loc/user/' . Auth::user()->name)
 						<b>Mutual</b>   
							@include('inc.userblock')
						@else  
							@include('inc.userblock')
						@endif
					@endif
				@endforeach
			@endif 
		</div>
	</div>
</div>
@endsection
