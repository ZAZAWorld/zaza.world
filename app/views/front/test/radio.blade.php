<html>
<head>
	<style>
		
	</style>
</head>
<body>
	<audio id="radioplayer" src="http://s1.slotex.pl:7196/;stream.mp3" autoplay="autoplay"></audio>
	<a href="#" onclick="document.getElementById('radioplayer').play()">Hi!</a>
	<a href="#" onclick="document.getElementById('radioplayer').pause()">Pause!</a>
	<input id="volume" name="volume" min="0" max="1" step="0.1" type="range" onchange="setVolume()">
	<script type="text/javascript">
		function setVolume() {
			document.getElementById("radioplayer").volume = document.getElementById('volume').value;
		}
	</script>
</body>
</html>