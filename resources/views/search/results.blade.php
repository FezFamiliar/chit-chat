@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Your search for "{{ Request::input('query') }}"</h3>

		@if(!$users->count())

			<h1>Sorry, nothing came up!</h1>


		@else
			<div class="row">
				<div clas="col-md-12">

					@foreach($users as $user)
						@include('inc.userblock')
					@endforeach
				</div>
			</div>
		@endif
	</div>
@endsection
