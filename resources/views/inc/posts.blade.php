<div class="media">
<a class="pull-left" href="{{ route('user.profile', ['username' => $post->user->name]) }}">
		@if(!is_null($post->user->profile))
			<img src="{{ asset('img\\') . $post->user->profile}}" alt="palceholder" class="media-object" width="80" height="80">
		@else
			<img src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?d=mm" alt="palceholder" class="media-object">
		@endif
	</a>
<div class="media-body">

	@if($post->user_id == Auth::user()->id)
		<a id="PostAction" class="post_action" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>

		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="PostAction">
			<a href="" class="dropdown-item">Edit</a>
			<a href="{{ route('delete.post', ['postid' => $post->id]) }}" class="dropdown-item">Delete</a>
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
	
	<ul class="list-inline">
		<li><a href="{{ route('like.post', ['postid' => $post->id]) }}">Like</a></li>
		<li><span class="like-peek" data-attribute={{$post->id}}>{{ $post->likes()->count() }}</span> &nbsp;{{ str_plural('Like', $post->likes()->count()) }}</li>
		<li>{{ $post->created_at->diffForHumans() }}</li>
	</ul> 
	@include('inc.modal')

	@foreach($post->replies as $reply)
		<div class="media">
			<a class="pull-left" href="{{ route('user.profile', ['username' => $reply->user->name]) }}">

			@if(!is_null($reply->user->profile))
				<img src="{{ asset('img') . $reply->user->profile}}" alt="palceholder" class="media-object" width="80" height="80">
			@else
				<img src="https://www.gravatar.com/avatar/{{ md5($reply->user->email) }}?d=mm" alt="palceholder" class="media-object">
			@endif
			</a>
			<div class="media-body">
				@if($reply->user_id == Auth::user()->id)
					<a id="PostAction" class="post_action" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="PostAction">
						<a href="" class="dropdown-item">Edit</a>
						<a href="{{ route('delete.post', ['postid' => $reply->id]) }}" class="dropdown-item">Delete</a>
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
				<ul class="list-inline">
					<li><a href="{{ route('like.post', ['postid' => $reply->id]) }}">Like</a></li>
					<li><span class="like-peek"  data-attribute={{$reply->id}}>{{ $reply->likes()->count() }}</span> &nbsp;{{ str_plural('Like', $reply->likes()->count()) }}</li>
					<li>{{ $reply->created_at->diffForHumans() }}</li>
				</ul>
			</div>
		</div>
	@endforeach

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