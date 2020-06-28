<div class="media">
<a class="pull-left" href="{{ route('user.profile', ['username' => $post->user->name]) }}">
		@if(!is_null($post->user->profile))
			<img src="{{ asset('img\\') . $post->user->profile}}" alt="palceholder" class="media-object" width="80" height="80">
		@else
			<img src="{{ asset('img/misc/mysteryman.png') }}" alt="palceholder" class="media-object">
		@endif
	</a>
<div class="media-body">

	@if($post->user_id == Auth::user()->id)
		@include('inc.edit', ['id' => $post->id])
	@endif
	<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $post->user->name]) }}">{{ $post->user->name }}</a></h4>
	@if(strpos($post->body, 'http') === 0)
		<p><a href="{{ $post->body }}">{{ $post->body }}</a></p>
	@elseif(strpos($post->body, 'http') > 0)
		<p>{{ substr($post->body,0,strpos($post->body, 'http')) }}
		<a href="{{ substr($post->body,strpos($post->body, 'http')) }}">{{ substr($post->body,strpos($post->body, 'http')) }}</a></p>
	@else
		<p>{{ $post->body }}</p>
	@endif
	<span class="cancel_m" data-attr={{$post->id}}>Cancel</span>
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
				<img src="{{ asset('img/misc/mysteryman.png') }}" alt="palceholder" class="media-object">
			@endif
			</a>
			<div class="media-body">
				@if($reply->user_id == Auth::user()->id)
					@include('inc.edit', ['id' => $reply->id])
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
				<span class="cancel_m" data-attr={{$reply->id}}>Cancel</span>
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