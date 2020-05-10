Pusher.logToConsole = true;

var pusher = new Pusher('187e54578846209f1cef', {
  cluster: 'eu'
});

var channel = pusher.subscribe('private-chit-channel');
channel.bind('Chat', function(data) {
  alert(JSON.stringify(data));
});