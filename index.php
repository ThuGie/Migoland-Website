<?php
	include "conf.php";
?><html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="shortcut icon" href="http://migo.spineworld.nl/favicon.ico">
		<title>Migo Land &#x00BB; Play now!</title>
                <meta name="Author" content="Playdo"/>
                <meta name="Description" content="Migo Land is a free online game where kids from all over the world become friends, play games, throw parties and have fun."/>
                <meta name="Keywords" content="Migo Land, Migo, parties, party, free, games, club, multiplayer, virtual world, dress up, avatar, create, friends, roleplaying, room design, room editor, trophies, education, social networking,  virtual community, mmo, mmorpg, playdo, world, online, highscore, kids, tweens"/>
		<script type="text/javascript" src="http://migo.spineworld.nl/js/swfobject.js"></script>
		<script type="text/javascript" src="http://migo.spineworld.nl/js/swffit.js"></script>
		<script type="text/javascript" src="http://migo.spineworld.nl/js/swfaddress.js"></script>
		<script type="text/javascript" src="http://migo.spineworld.nl/js/ga.js"></script>
		<script type="text/javascript" src="http://migo.spineworld.nl/js/PluginDetectShockWave.js"></script>
                <script type="text/javascript" src="http://migo.spineworld.nl/js/browserDetect.js"></script>
		<script type="text/javascript">
                        var wmode = "window";
                        var isff36 = 'false';
						var browser = BrowserDetect.browser;
                        if(browser == "Firefox"){
                            if(BrowserDetect.version < 3.6){
                                wmode = "transparent";
                            }else{
                                isff36 = 'true';
                            }
                        }else if(browser == "Explorer"){
                                wmode = "opaque";
                        }else if(browser == "Opera"){
							wmode = "transparent";
							isff36 = 'true';
						}
			var flashvars = {path:'Back.swf', sc: 'http://migo.spineworld.nl/', fc: 'http://migo.spineworld.nl/', wd: '<?php echo $isbanned; ?>', lsa: 'true', isff36: isff36, browser: browser};
			var params = {bgcolor:"#94d13e",
						quality:"high",
						allowScriptAccess:"always",
						wmode: wmode,
						name:"Back",
						width:"100%",
						height:"100%",
						align:"middle",
						play:"true",
						loop:"false" };
			var attributes = {id: "Back"};
			swfobject.embedSWF("http://migo.spineworld.nl/Back.swf", "maindiv", "100%", "100%", "9.0.28", "", flashvars, params, attributes);
			swffit.fit("Back",970,750);
		</script>
		<style type="text/css">
			body{ background-color: #94d13e;	margin:0px;}
		</style>
	</head>
	<body>
		<div id="maindiv">
			<div style="width:348px; height:170px; margin:0px auto;"><a href="http://www.adobe.com/products/flashplayer" target="_blank"><img src="http://migo.spineworld.nl/images/noflash.png" style="border:0px none #000; display:inline;"/></a></div>
		</div>
	</body>
</html>
