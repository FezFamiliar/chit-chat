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
			<h3>{{ $user->name }}'s posts</h3>
		 	 @if($posts->count() > 0)
	            @foreach($posts as $post)
		            <div class="media">
		     				<a class="pull-left" href="{{ route('user.profile', ['username' => $post->user->name]) }}"><img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?d=mm" alt="{{ $post->user->name }}"></a>
						<div class="media-body">
		   					<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $post->user->name]) }}">{{ $post->user->name }}</a></h4>
									<p>{{ $post->body }}</p>
							<ul class="list-inline">
								<li>10 likes</li>
								<li><a href="">Like</a></li>
								<li>{{ $post->created_at->diffForHumans() }}</li>
							</ul>
					{{-- @if($AuthUserIsFriend) --}}
						@foreach($post->replies as $reply)
									<div class="media">
								<a class="pull-left" href="{{ route('user.profile', ['username' => $reply->user->name]) }}"><img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($reply->user->email) }}?d=mm" alt="{{ $reply->user->name }}"></a>

								<div class="media-body">
									<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $reply->user->name]) }}">{{ $reply->user->name }}</a></h4>
									<p>{{ $reply->body }}</p>
										<ul class="list-inline">
											<li><a href="">Like</a></li>
											<li>10 likes</li>
											<li>{{ $reply->created_at->diffForHumans() }}</li>
										</ul>
									</div>
								</div>
							@endforeach
				{{-- @endif --}}
				<form action="{{ route('reply.post', ['postid' => $post->id]) }}" method="post">
					@csrf

					<div class="form-group">
						<textarea class="form-control" rows="2" name="reply-{{ $post->id }}" placeholder="Reply to this"></textarea>
					</div>
					@if($errors->has("reply-$post->id" ))
					    <span class="help-block">
							This field is required.
						</span>
					@endif
					<input class="btn btn-default btn-sm" type="submit" value="Reply">
				</form>
				</div>
				</div>
				<hr>
	        @endforeach
	        @else
	               {{ $user->name }} don't have any posts yet.
	        @endif 
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
 						@if(Auth::user()->isFriendsWith($user) && Request::url() != 'http://chitchat.loc/user/' . rawurlencode(Auth::user()->name))
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
