<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'eu',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    'e8b74b284b8bffaa6f10',
    'ffc6da4b885c31232c90',
    '630935',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my_channel', 'my_event', $data);
?>

<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e8b74b284b8bffaa6f10', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('my_channel');

    channel.bind('my_event', function(data) {
      var message = data.message;
    });
  </script>
  <?php 
  
  echo "<script> var message </script>"?>

</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>
