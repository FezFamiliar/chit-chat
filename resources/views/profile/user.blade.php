@extends('layouts.app')

@section('content')
<div class="container">
	@include('inc.flash')
	<div class="row">
		@include('inc.modal')
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
			@if(Auth::user()->isFriendsWith($user) || Request::url() == 'http://chitchat.loc/user/' . rawurlencode(Auth::user()->name))				
		 	 @if($posts->count() > 0)
	            @foreach($posts as $post)
		            <div class="media">
		     				<a class="pull-left" href="{{ route('user.profile', ['username' => $post->user->name]) }}">

									@if(is_null($post->user->profile))
										<img class="media-object" src="https://www.gravatar.com/avatar/ {{ md5( $post->user->emai) }}?d=mm" alt="placeholder">
									@else
										<img class="media-object" src="{{ asset('img') . $post->user->profile }}" alt="placeholder">
									@endif

		     				</a>
						<div class="media-body">
								@if($post->user_id == Auth::user()->id)
								<a class="post_action" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre title="Edit or delete this"></a>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="PostAction">
									<li class="dropdown-item"><span class="edit"></span>Edit</li>
									<a href="{{ route('delete.post', ['postid' => $post->id]) }}" class="dropdown-item"><span class="delete"></span>Delete</a>
								</div>
							@endif
		   					<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $post->user->name]) }}">{{ $post->user->name }}</a></h4>
		   						@if(strpos($post->body, 'http') === 0)
									<a href="{{ $post->body }}">{{ $post->body }}</a>
								@elseif(strpos($post->body, 'http') > 0)
									<p>{{ substr($post->body,0,strpos($post->body, 'http')) }}
									<a href="{{ substr($post->body,strpos($post->body, 'http')) }}">{{ substr($post->body,strpos($post->body, 'http')) }}</a></p>
								@else
									<p>{{ $post->body }}</p>
								@endif
							<span class="cancel_m" data-attr={{ $post->id }}>Cancel</span>
							<ul class="list-inline">
								<li><a href="{{ route('like.post',['postid' => $post->id]) }}">Like</a></li>
								<li><span class="like-peek" data-attribute={{$post->id}}>{{ $post->likes->count() }}</span> &nbsp;{{ str_plural('Like', $post->likes()->count()) }}</li>
								<li>{{ $post->created_at->diffForHumans() }}</li>
							</ul>
					 {{-- @if($AuthUserIsFriend) --}} 
						@foreach($post->replies as $reply)
									<div class="media">

								<a class="pull-left" href="{{ route('user.profile', ['username' => $reply->user->name]) }}">
									@if(is_null($reply->user->profile))
										<img class="media-object" src="https://www.gravatar.com/avatar/ {{ md5( $reply->user->emai) }}?d=mm" alt="placeholder">
									@else
										<img class="media-object" src="{{ asset('img') . $reply->user->profile }}" alt="placeholder">
									@endif

								</a>

								<div class="media-body">
									@if($reply->user_id == Auth::user()->id)
										<a class="post_action" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-hover="tooptip" v-pre title="Edit or delete this"></a>

										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="PostAction">
											<li class="dropdown-item"><span class="edit"></span>Edit</li>
											<a href="{{ route('delete.post', ['postid' => $reply->id]) }}" class="dropdown-item"><span class="delete"></span>Delete</a>
										</div>
									@endif
									<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $reply->user->name]) }}">{{ $reply->user->name }}</a></h4>
										@if(strpos($reply->body, 'http') === 0)
											<a href="{{ $reply->body }}">{{ $reply->body }}</a>
										@elseif(strpos($reply->body, 'http') > 0)
											<p>{{ substr($reply->body,0,strpos($reply->body, 'http')) }}
											<a href="{{ substr($reply->body,strpos($reply->body, 'http')) }}">{{ substr($reply->body,strpos($reply->body, 'http')) }}</a></p>
										@else
											<p>{{ $reply->body }}</p>
										@endif
										<span class="cancel_m" data-attr={{ $reply->id }}>Cancel</span>
										<ul class="list-inline">
											<li><a href="{{ route('like.post',['postid' => $reply->id]) }}">Like</a></li>
											<li><span class="like-peek" data-attribute={{$reply->id}}>{{ $reply->likes->count() }}</span> &nbsp;{{ str_plural('Like', $reply->likes()->count()) }}</li>
											<li>{{ $reply->created_at->diffForHumans() }}</li>
										</ul>
									</div>
								</div>
							@endforeach
				 {{-- @endif  --}}
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
 	        		@if(Request::url() == 'http://chitchat.loc/user/' . rawurlencode(Auth::user()->name))
	              		 you dont have any posts yet.
	              		@else
	              		{{ $user->name }} doesn't have any posts yet.
	               @endif
	        @endif
	        @else 
	        		You and {{ $user->name }} are not friends.
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
