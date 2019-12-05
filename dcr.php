<html>
    <head>
        <script type="text/javascript" src="/js/dcr.js"></script>
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="/js/protocolcheck.js"></script>
		 <style>
body {
  background-image: url('images/background2.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  //background-size: cover;
}
</style> 
    </head>
    <body style="background-color:#94d13e; margin:0px; padding: 0px; overflow: hidden; display:block;">
			<center><br><br><br><div id="no-launcher" style="display: block;">
			Make sure you have downloaded the Migoland Launcher from<br>
			<a href='http://migo.spineworld.nl/Migoland-Setup.exe'>Download</a><br>
			After downloading and installing press Launch Migoland below!<br><div id="protocol" href="mllauncher:hashhere">Launch Migoland</div></div></center>
            

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

</html>