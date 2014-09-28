<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<style type="text/css">
		#wrapper {
			width: 1280px;
			height: 800px;
			margin: 0 auto;
			position: relative;
			overflow: hidden;g
		}

		#background {
			background-image: url("images/STUE_table_windows.png");
			position: relative;
			height: 100%;
			z-index: 0;
		}

		#frames {
			position: relative;
			left: 748px;
			top: 86px;
		}

		#frames #large {
			/*background-image: url("images/FRAME_large.png");*/
			width: 248px;
			height: 150px;
			position: relative;
		}

		#frames img {
			width: 100%;
			height: 100%;
			border: 10px solid #f6d763;
		}

		#frames #curly {
			background-image: url("images/FRAME_curly.png");
			width: 147px;
			height: 167px;
			position: relative;
			top: 30px;
		}

		#frames #small {
			background-image: url("images/FRAME_small.png");
			width: 117px;
			height: 132px;
			position: relative;
			left: 168px;
			top: -130px;
		}

		#newspaper {
			background-image: url("images/AVIS.png");
			width: 100px;
			height: 110px;
			position: relative;
			background-size: cover;
			/*left: 750px;*/
			top: 210px;
			z-index: 2;
		}

		#stamtrae {
			background-image: url("images/stamtrae.png");
			width: 120px;
			height: 70px;
			position: relative;
			background-size: cover;
			top: -100px;
			left: -450px;
		}

		#grammofon {
			background-image: url("images/old-gramophone.png");
			height: 200px;
			width: 200px;
			position: relative;
			left: 70px;
			top: -80px;
			background-size: cover;
		}



	</style>
</head>
<body>
	<div id="wrapper">
		<div id="background">
			<div id="frames">
				<div id="large">
					<img src="images/yearimgs/<?= $_GET['year'] ?>.jpg"
				</div>
				<div id="curly"></div>
				<div id="small"></div>
			</div>
			<div id="newspaper"></div>
			<div id="stamtrae"></div>
			<div id="grammofon"></div>

		</div>
	</div>
	<script>



	</script>
</body>
</html>