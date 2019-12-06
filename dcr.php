<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="js/dcr.js"></script>
		<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="js/protocolcheck.js"></script>
		<link rel="stylesheet" type="text/css" href="css/launch.css" />
	</head>
	<body>
		<!-- Information -->
		<div id="box">
			<p>Make sure you have downloaded the Migoland Client from <a href='http://migo.spineworld.nl/Migoland-Setup.exe'>here!</a></p>
			<p>After downloading and installing press 'play' below!</p>
		</div>

		<!-- The play button -->
		<div id="protocol" href="mllauncher:hashhere"><img src="images/buttons/btn_play.png"></img></div>
		

		<!-- Migoland launch script -->
		<script>
		var launcherid = document.getElementById('no-launcher');
		        $("#protocol").click(function (event) {
		            protocolCheck($(this).attr("href"), function () {
					launcherid.style.display = 'block';
		});
		event.preventDefault ? event.preventDefault() : event.returnValue = false;

		});
		$( "#protocol" ).trigger( "click" );
		</script>

	</body>
</html>
