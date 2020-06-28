<div class="media">
	<a href="{{ route('user.profile', ['username' => $user->name]) }}" class="pull-left">
		@if(!is_null($user->profile))
			<img src="{{ asset('img') . $user->profile}}" alt="palceholder" class="media-object" width="80" height="80">
		@else
			<img src="{{ asset('img/misc/mysteryman.png') }}" alt="palceholder" class="media-object">
		@endif
	</a>
	<div class="media-body">

			<h4 class="media-heading"><a href="{{ route('user.profile', ['username' => $user->name])}}"> {{ $user->name }}</a></h4>
			@if(!is_null($user->location))
				<p>{{ $user->location }}</p>
			@endif
	</div>
</div>