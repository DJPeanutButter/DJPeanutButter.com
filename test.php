<html>
	<head>
		<title>Test</title>
	</head>
	<body>
	<?
	$dir = 'memes';
	$files = scandir($dir);
	foreach ($files as $f){
		if ($f=="." or $f=="..")
			continue;
	?><img src='memes/<?
		echo $f;
	?>
	'><br/>
	<?}?>
	</body>
</html>
	