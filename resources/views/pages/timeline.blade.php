@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Dashboard</div>

	                <div class="card-body">
	                    @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('status') }}

	                        </div>
	                    @endif

	                    @if(Auth::guest())
	                         <h1 class="text-center">You are not signed in!</h1> 
	                    @endif
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection