<html>
	<head>
		<title>DJ PeanutButter's Website, Bitches!</title>
		<link rel="stylesheet" type="text/css" href="layout-styles.css">
		<base href="http://www.djpeanutbutter.com/">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="col-12 gray"></div>
		<div class="menu">
		<?
				$menuFile = fopen("menu.html", "r") or die("Unable to load menu!");
				echo fread($menuFile,filesize("menu.html"));
				fclose($menuFile);
			?>
		</div>
		<div class="col-10 white">
			<div class="col-12 white">&nbsp;</div>
			<div class="col-12 white" style="font-size: 200%;">Welcome to DJPeantuButter.com!</div>
			<div class="col-12 white">Your home for dank memes, quality music and sweet free sheet music!</div>
			<div class="col-12 white">&nbsp;</div>
		</div>
	</body>
</html>