@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    
            @if(Auth::guest())
                 <h1 class="text-center">You are not signed in!</h1> 
            @endif
    </div>
</div>
@endsection
