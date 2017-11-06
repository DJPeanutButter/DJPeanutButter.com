<html>
	<head>
		<title>CurveBall Launcher</title>
		<base href="http://www.djpeanutbutter.com/">
		<link rel="stylesheet" type="text/css" href="layout-styles.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div class="col-12 gray"></div>
		<div class="menu">
		<?
				include ("../menu.html");
			?>
		</div>
		<div class="col-10 white">
			<div class="col-12 white">&nbsp;</div>
			<div class="col-12 white">CurveBall Launcher</div>
			<div class="col-12 white">&nbsp;</div>
			<div class="col-12">
                <div class="col-12">Click the link below to open CurveBall.<br>Use space bar to start and the arrow keys to move your paddle, keep the ball in the air and gain points by hitting the ball while the paddle is moving. When serving, you aren't allowed to hit the walls, doing so will result in a fault. When you let the ball fall past the paddle, if you have less points than your opponent had last turn, you lose the point. If you have more points or it was a serve, the ball gets sent to the opposing player (also human controlled for now). When this happens, the paddle resets and the ball starts where it falls. If the ball lands in the spot that the paddle resets (marked with red), the paddle will not reset. Have fun!</div>
				<a href="javascript:void(0);" onClick="window.open('games/CurvePong 1.0.html', 'CurveBall 1.0', 'toolbar=no,resizable=yes,scrollbars=yes,width=1450,height=1000,left=0,top=0')" title="Launch CurveBall"><div class="col-10">Launch!</div></a>
			</div>
		</div>
	</body>
</html>