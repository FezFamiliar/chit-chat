@extends('layouts.app')

@section('content')
	<div class="container">
		@include('inc.flash')
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	        		<form method="POST" action="{{ route('search.results') }}" id="post">
	        			<div class="form-group">
		            		<textarea type="text" name="post" class="form-control" placeholder="Whats on your mind, {{ Auth::user()->name }}?" rows="3"></textarea>
	        			</div>
	        			<div class="form-group">
	        				<input type="submit" value="Post" class="btn btn-outline-info">
	        			</div>
	            	</form>
	            <div class="card">
	                <div class="card-header">Dashboard</div>

	                <div class="card-body">
{{-- 	                    @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('status') }}

	                        </div>
	                    @endif --}}

	                    @if(Auth::guest())
	                         <h1 class="text-center">You are not signed in!</h1> 
	                    @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection