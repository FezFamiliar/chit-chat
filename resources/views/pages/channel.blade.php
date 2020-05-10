@extends('layouts.app')

@section('content')
<div class="container">
      <form action="send" method="POST" autocomplete="off" > 
        <div class="form-group">
            <textarea name="content" rows="4" cols="40" class="form-control"></textarea>
        </div>
          <input type="submit" value="Send" class="btn btn-primary">
          @csrf
      </form>
</div>

@endsection



