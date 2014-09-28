<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test</title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<script src="utils.js"></script>
	<style type="text/css">
		#wrapper {
			width: 1280px;
			height: 800px;
			margin: 0 auto;
			position: relative;
		}

		#wall {
			background-image: url("images/doropgang_m_bg.png");
			height: 100%;
			z-index: 0;
		}

		#door-wrapper {
			/*background-color: #a3bfb7;*/
			overflow: hidden;
			width: 311px;
			height: 741px;
			z-index: 1;
			left: 164px;
			position: relative;
			top: 29px;
			background-size:100% 100%;
		    -o-background-size: 100% 100%;
		    -webkit-background-size: 100% 100%;
		    background-size:cover;
		    cursor: pointer;
		}

		#door {
			background-image: url("images/door.png");
			width: 100%;
			height: 100%;
			position: relative;
			left: 0px;
			cursor: pointer;
		}

		#plate {
			/*background-color: #f5d662;*/
			background-image: url("images/door_sign_large.svg");
			background-size: cover;
			width: 245px;
			height: 128px;
			left: 500px;
			top: -400px;
			position: relative;
			z-index: 3;
			cursor: pointer;
		}

		#plate span {
			padding: 20px;
			display: block;
			text-align: center;
		}

		#time-slider {
			position: relative;
			top: -580px;
			left: 500px;
			width: 240px;
		}

		#slider-range-min {
			/*width: 240px;*/
		}

		#time-slider #time-display {
			width: 100%;
			text-align: center;
			display: inline-block;
		}

		#spinner {
			width: 30px;
			margin: 0 auto;
		}
/*		#spinner {
			width: 30px;
		    height: 30px;
		    background-image: url("images/spiffygif_30x30.png");

		    -webkit-animation: play .8s steps(10) infinite;
		       -moz-animation: play .8s steps(10) infinite;
		        -ms-animation: play .8s steps(10) infinite;
		         -o-animation: play .8s steps(10) infinite;
		            animation: play .8s steps(10) infinite;
		}

		@-webkit-keyframes play {
		   from { background-position:    0px; }
		     to { background-position: 	  570px; }
		}

		@-moz-keyframes play {
		   from { background-position:    0px; }
		     to { background-position: 	  570px; }
		}

		@-ms-keyframes play {
		   from { background-position:    0px; }
		     to { background-position: 	  570px; }
		}

		@-o-keyframes play {
		   from { background-position:    0px; }
		     to { background-position: 	  570px; }
		}

		@keyframes play {
		   from { background-position:    0px; }
		     to { background-position: 	  570px; }
		}*/


	</style>
</head>
<body>
	<div id="wrapper">
		<div id="wall">
			<div id="door-wrapper">
				<div id="door"> </div>
			</div>
			<div id="plate"><span></span></div>
			<div id="time-slider">
				<span id="time-display">1890</span>
				<div id="spinner">
					<img src="images/spiffygif_30x30.gif" >
				</div>
				<div id="slider-range-min"></div>
			</div>
		</div>
	</div>
	<script>

		function getRegByYear(year, regs) {
			var reg = undefined;
			for(var i = 0; i < regs.length; i++){
				if(regs[i].date == undefined) continue;
				var dateYear = regs[i].date.split("-")[2];
				if(dateYear == year){
					return regs[i];
				}
			}
		}

		function getNamesFromReg(reg) {
			var persons = reg.persons;
			var names = [];
			for(var i = 0; i < persons.length; i++)
			{
				names[i] = persons[i].firstnames + " " + persons[i].lastname;
			}

			return names;
		}

		$(document).ready(function(){

			// get data
			var api = "http://" + window.location.host + "/HACK4DK-2014/api/";

			var endpoint = api + "persons" + getQueryString();
			console.log(endpoint);

			$(window).on("dataFetched", function(event, data){
				console.log(data);
			});

			$.get(endpoint).then(function(registerblade){
				window.registerblade = registerblade;
				$(window).trigger("dataFetched");
			});


			toggleAnimation($("#door"), "click", {left: "-300px"});
			toggleAnimation($("#plate"), "click",
				{"width": "490px", "height": "256px", "font-size": "3em"}
			);

			$("#door-wrapper").click(function(e){
				console.log($("#door").hasClass("active"));
				if($("#door").hasClass("active")) {
					e.stopPropagation();
					window.location.href =
						window.location.href.replace("outside-door", "inside-door") +
						"&year=" + $("#time-slider").text();
				}
			});

		});
	</script>
	<script>
		$(window).on("dataFetched", function(evt) {
		  $("#spinner").css("display", "none");
		  $("#slider-range-min").slider({
		    range: "min",
		    value: 1890,
		    min: 1890,
		    max: 1924,
		    slide: function( event, ui ) {
		    	var reg = getRegByYear(ui.value, window.registerblade);
		    	if(reg == undefined) return;

	    		names = getNamesFromReg(reg);
	    		if(names.length == 0) return;
	    		console.log(names[0]);
	    		var html = "";
	    		for(var j = 0; j < names.length; j++) {
	    			html += names[j] + ((j != names.length - 1) ? " &amp;<br/>" : "");
	    		}
	    		$( "#time-display" ).text( ui.value );
	    		$("#plate span").html(html);
		    }
		  });
		});
		</script>
	</script>
</body>
</html>