<div class="media">
<a class="pull-left" href="{{ route('user.profile', ['username' => Auth::user()->name]) }}"><img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?d=mm" alt="{{ $post->user->name }}"></a>
<div class="media-body">
	<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => Auth::user()->name]) }}">{{ $post->user->name }}</a></h4>
	<p>{{ $post->body }}</p>
	<ul class="list-inline">
		<li>{{ $post->created_at }}</li>
		<li><a href="">Like</a></li>
		<li>10 likes</li>
	</ul>

{{-- 		<div class="media">
		<a class="pull-left" href="#"><img class="media-object" src="" alt=""></a>

		<div class="media-body">
		<h4 class="media-heading"><a href="">Dayle</a></h4>
		<p>It's a lovely day today.</p>
		<ul class="list-inline">
			<li>2 days ago</li>
			<li><a href="">Like</a></li>
			<li>10 likes</li>
		</ul>
	</div>
</div> --}}
<form action="" method="post">
	<div class="form-group">
		<textarea class="form-control" rows="2" placeholder="Reply"></textarea>
	</div>
	<input class="btn btn-default btn-sm" type="submit" name="" value="Reply">
</form>
</div>
</div>
<hr>