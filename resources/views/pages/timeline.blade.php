@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	        	@include('inc.flash')
	        		<form method="POST" action="{{ route('post.it') }}" id="post">
	        			@csrf
	        			@if($errors->has('post-body'))
	        				<div class="alert alert-danger">
	        					This field is required.
	        				</div>
	        			@endif
	        			<div class="form-group">
		            		<textarea type="text" name="post-body" class="form-control" placeholder="Whats on your mind, {{ Auth::user()->name }}?" rows="3"></textarea>
	        			</div>
	        			<div class="form-group">
	        				<input type="submit" value="Post" class="btn btn-outline-info">
	        			</div>
	            	</form>
	            <div class="card"> 
	                <div class="card-header mb-3">Dashboard</div>
	                @if($posts->count() > 0)
	                	@foreach($posts as $post)
	                		@include('inc.posts')
	                	@endforeach
	                @else
	                	<p class="text-center">Theres nothing here, yet</p>
	                @endif
	             </div>
	        </div>
	    </div>
	</div>
@endsection