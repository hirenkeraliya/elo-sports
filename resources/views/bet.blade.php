@extends('master')


@section('content')


<!-- Add a placeholder for the Twitch embed -->
<div id="twitch-embed", style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%)"></div>

<!-- Load the Twitch embed script -->
<script src="https://player.twitch.tv/js/embed/v1.js"></script>

<!-- Create a Twitch.Player object. This will render within the placeholder div -->
<script type="text/javascript">
  new Twitch.Player("twitch-embed", {
    channel: "hasty4",
    width: "1000",
    height: "800"
  });
</script>
<h1>Current Bet: Dapr</h1>


@endsection