@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
		{{-- 	{{ dd(Session::get('settings')) }} --}}
			<table class="table">
			  <thead>
			    <tr>
			      <th>General</th>
			      <th>Active</th>
			    </tr>
			  </thead>
			  <tbody>
 			  	@foreach($settings as $setting)
				    <tr>
				      <td>{{ $setting->body }}</td>
				      <td>@include('inc.checkbox')</td>
				    </tr>
			    @endforeach 
			  </tbody>
			</table>
		</div>
	</div>
@endsection


<!--

	1. Allow friends to tag you and/or share your post?
	2. Do you want to receive e-mail notifications when your friends post something?
	3. Do you want to receive e-mail notifications when your friends send you a friend requesrt?
	4. let ur friend be able to tag yu?


-->