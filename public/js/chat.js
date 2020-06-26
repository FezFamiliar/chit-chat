Pusher.logToConsole = true;

var pusher = new Pusher('187e54578846209f1cef', {
  cluster: 'eu'
});

var channel = pusher.subscribe('chit-channel');
channel.bind('Chat', function(data) {

  var t = $('#msg-placeholder');
  var msg = data.content;
  console.log(msg);
  t.append(msg);
  
});