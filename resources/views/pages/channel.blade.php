@extends('layouts.app')

@section('content')

  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('187e54578846209f1cef', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('chit-channel');
    channel.bind('Chat', function(data) {
      alert(JSON.stringify(data));
    });

  //   channel.bind('subscription_succeeded', function(members) {
  //   alert('successfully subscribed!');
  // });
  </script>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>


  <form action="send" method="POST" autocomplete="off">	
  		<textarea name="content" rows="4" cols="40"></textarea>
  		<input type="submit" value="Send">
      @csrf
  </form>
@endsection



