@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<table class="table">
			    <tr>
			      <th>General</th>
			      <th class="text-right" style="padding-right: 50px;">Active</th>
			    </tr>
 			  	@foreach($settings_all as $setting)
					<tr>
				      <td>{{ $setting->body }}</td>
				      <td class="text-right">@include('inc.checkbox')</td>
				    </tr>
			    @endforeach 
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