<html>
	<head>
		<title>DJ PeanutButter's Dank Memes</title>
		<link rel="stylesheet" type="text/css" href="layout-styles.css">
		<base href="http://www.djpeanutbutter.com/">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			<?
				$dir = 'memes';
				$files = scandir($dir);
				?>div#p0{
			<?for ($s=sizeof($files);($s-2)>0;$s--){
					?>	background: url(memes/<?echo $files[$s]?>) no-repeat -9999px -9999px;
			<?}?>}
			
			img.meme {
				border-radius:	5px;
				cursor:			pointer;
				transition:		0.3s;
			}
			
			.modal{
				display:			none;
				position:			fixed;
				z-index:			1;
				padding-top:		100px;
				left:				0;
				top:				0;
				width:				100%;
				height:				100%;
				overflow:			auto;
				background-color:	rgb (0, 0, 0);
				background-color:	rgba(0, 0, 0, 0.9);
			}
			.modalContent {
				margin:		auto;
				display:	block;
				width:		80%;
				max-width:	700px;
			}
			
			#caption {
				margin:		auto;
				display:	block;
				width:		80%;
				max-width:	700px;
				text-align:	center;
				color:		#ccc;
				padding:	10px 0;
				height:		150px;
			}
			
			.modalContent, #caption {
				-webkit-animation-name:		zoom;
				-webkit-animation-duration:	0.6s;
				animation-name:				zoom;
				animation-duration:			0.6s;
			}
			
			@webkit-keyframes zoom {
				from{-webkit-transform:	scale (0)}
				to	{-webkit-transform:	scale (1)}
			}
			
			@keyframes zoom {
				from{transform:	scale (0)}
				to	{transform:	scale (1)}
			}
			
			.modalClose {
				position:		absolute;
				top:			15px;
				right:			35px;
				color:			#f1f1f1;
				font-size:		40px;
				font-weight:	bold;
				transition:		0.3s;
			}
			
			.modalClose:hover,
			.modalClose:focus {
				color:				#bbb;
				text-decoration:	none;
				cursor:				pointer;
			}
			
			/* 100% Image Width on Small Screens */
			@media only screen and (max-width: 700px){
			.modal-content {
				width: 100%;
			}
		</style>
		
		
	</head>
	<body>
		<!--Menu-->
		<div class="col-12 gray"></div>
		<div class="menu">
		<?
				$menuFile = fopen("menu.html", "r") or die("Unable to load menu!");
				echo fread($menuFile,filesize("menu.html"));
				fclose($menuFile);
			?>
		</div>
		
		<!--DIVS for pre-loading images-->
		<div class="pl" id="p0"></div>
		
		<!--Modal DIV prototype-->
		<div id="modalDiv" class="modal">
			<span class="modalClose" onClick="document.getElementById ('modalDiv').style.display = 'none'">&times;</span>
			<img class="modalContent" id="modalImg">
			<div id="modalCaption"></div>
		</div>
		
		
		<script>
			var modal = document.getElementById ('modalDiv');
			var modalImg = document.getElementById ('modalImg');
			var captionText = document.getElementById ('modalCaption');
			
			function modalClick (e){
				modal.style.display		= "block";
				modalImg.src			= e.src;
				captionText.innerHTML	= e.alt;
			}
		</script>
		
		<!--Main Page Content-->
		<div class="col-10 gray">
			<?
				for ($i=$s=sizeof($files);$i>2;$i--){
					if (($s-$i)%6==0){
						if (($s-$i)>0){
							?></div>
			<?
						}
					?><div class="col-">
			<?
					}
					?>	<div class="col-2"><img class="meme" onclick="modalClick (this)" <?echo "src='memes/"; echo $files[$i-1]; echo "'";?>></div>
			<?
				}
				?></div>
		</div>
	</body>
</html>