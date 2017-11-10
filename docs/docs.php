<html>
	<head>
		<title>DJ PeanutButter's Programming Tutorials</title>
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
			<div class="col-12 white">Programming Tutorials and Documentation</div>
			<div class="col-12 white">&nbsp;</div>
			<div class="col-12">
				<a href="docs/cpp.php"><div class="col-10">C++</div></a>
			</div>
		</div>
	</body>
</html>