@extends('layouts.app')
	@section('content')
	    @if(Auth::guest())
	         @include('inc.landing') 
	    @endif
	@endsection
