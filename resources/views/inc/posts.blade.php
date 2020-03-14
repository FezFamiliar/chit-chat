<div class="media">
<a class="pull-left" href="{{ route('user.profile', ['username' => $post->user->name]) }}"><img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($post->user->email) }}?d=mm" alt="{{ $post->user->name }}"></a>
<div class="media-body">
	<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $post->user->name]) }}">{{ $post->user->name }}</a></h4>
	<p>{{ $post->body }}</p>
	<ul class="list-inline">
		<li><a href="{{ route('like.post', ['postid' => $post->id]) }}">Like</a></li>
		<li><span class="like-peek"  {{-- data-toggle="modal" data-target="#myModal" --}}  data-attribute={{$post->id}}>{{ $post->likes()->count() }} &nbsp;{{ str_plural('Like', $post->likes()->count()) }}</span></li>
		<li>{{ $post->created_at->diffForHumans() }}</li>
	</ul> 
	@include('inc.modal')

	@foreach($post->replies as $reply)
		<div class="media">
			<a class="pull-left" href="{{ route('user.profile', ['username' => $reply->user->name]) }}"><img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($reply->user->email) }}?d=mm" alt="{{ $reply->user->name }}"></a>

			<div class="media-body">
				<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $reply->user->name]) }}">{{ $reply->user->name }}</a></h4>
				<p>{{ $reply->body }}</p>
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
<script type="text/javascript">
$( document ).ready(function() {
	$("#myModal").on("hidden.bs.modal", function(){
	    $("#myModal .modal-body").html("");
	});
	$('.like-peek').click(function(e){
		// e.preventDefault()
		var id = $(this).attr('data-attribute');

		   $.ajax({
            type: "GET",
            url: "/show/likes/" + id,
            success: function (data) {
            	var n = data['success']['length'];


            	for(var i = 0;i < n;i++){

             	   $("#myModal .modal-body").append(data['success'][i] + '<br>');
            	}
                $("#myModal").modal("show");
            }
     });
  }); 
});
</script>