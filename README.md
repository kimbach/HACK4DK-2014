-HACK4DK---2014
===============

#HACK4DK - 2014

== Description ==

Presentation of data in an exciting, sexy and visual manner

== Codebase ==

https://github.com/kimbach/-HACK4DK---2014 

== "Band"-members ==

=== Maria Wehde, CEO (Chief Executive Officer), MC and DJ. === 
Roles:  Creative lead, Concept, Presentation/Mock-up  and Media)

Contact: mariawehde@gmail.com

=== Cecilie Warming, CHO (Chief Happiness Officer), DJ. === 
Roles: Management lead, Design, Media and Project management)

Contact:

=== Adam Schønemann, CTO ( Chief Technical Officer), MC and DJ. ===

Roles: Technical lead, backend and integration)

Contact:

=== Niels Jarler, CDO (Cheif Design Officer), MC and DJ. === 

Roles: Design lead, Design and Look and feel)

Contact:

=== Kim Bach, CCO (Cheif Community Officer), MC and DJ. ===
 
Roles: Hax and documentation (can you use those two words together? Apparently!), 

Website: http://kimbach.org

Contact (ordered by prefered mode): 
# Skype: kim.bach  
# mailto:kim.bach@gmail.com  
# Dansk Wikipedia: https://da.wikipedia.org/Bruger:Kim_Bach,  
# Ello: @kimbach  
# Twitter: @kim_bach  
# Facebook: kim.bach  
# https://www.linkedin.com/in/kimbachorg  
# tel:+4522256951 (TEXT only)  

(Sorry about the start-up and hip-hop “rethorics”, but I (Kim Bach)  think #HACK4DK is lacking it ;-) - so this is entirely on my own account)

== Project goals ==

Display of data from different sources using time as a parameter.

Place at a given time in history (in Denmark) displayed on a timeline dk
data for the “common wo/man to play with”

=== Post-hack goal ===
A functional example that is drawing on at least 2 datasets, visualised using a map and a  graphical representation of a stair well with appartments.

== Architecture ==

Idea is to build a new API based on the Address Web Service (AWS) API (http://webapi.aws.dk/) creating a service that is plugable to other datasets while adding a temporal dimension.

A common API that is providing access to all open datasets (historic/geographic). Three different means of delivery depending on the user:

== Use cases ==

Using a map to navigate and a slider to change the current time triggering a dynamic search that drills down and filters the relevant datasets by year.

=== Modes ===

==== Scientist/researcher:====
Can search using time, place person etc. with data from the different data sets. the purpose is to provide a way to display new connections and patterns across data. 

==== Casual browser/currious user ====

Here we for instance use the interface can be utilised or extended with a 3D-version from eg. Google Streetview, Mapillary OpenStreetMap 3D etc.. -over time an extra layer like crowdsourcing ca be added (so users can provide additional information) and cross-reference with a genealogy database using a heraldic tree etc.

===== Example (post-hack target) =====
Click on an address in a map and a door well with names on the door is shown, the names are changing depending on the year that is selected using a slider, the screen is displaying who lived in the apartment in a given year (based on the registerblade from the Copenhagen Police 1890-1924). after this you can enter a given apartment at a given time. when inside the apartment is showing more data from several data sets pictures in picture frames, radio/tv shcdules shown on radio/tv sets, weather outside the windows, newspaper headlines on newspaper, etc. you can exit the room and re-enter to display data from a different time. 

==== Education ====

Presentation of data af data in-game i minecraft. Kan være eksempelvis fortidsminder, hvor data fra fund og fortidsminder vises native i spillet (på skilte og i notesbøger samt som billedrammer) eller i en udvidet udgave kan bestemte adresser udvælges, og husene kan bygges og “befolkes” med data.

== Used datasets and APIs ==

=== Politietsregisterblade, API v. 1.0 ===

First use-case is “registerblade” in Copenhagen using the dataset from Politietsregisterblade, API v. 1.0 http://www.politietsregisterblade.dk/api/1/info.html

A new point-release was developed in-hack!

=== Leaflet API for OpenStreetMap ===

A clickable map based on OpenStreetMap.

http://leafletjs.com/

=== Address Web Service (AWS) API ===

We use the reverse geo-lookup service.

http://webapi.aws.dk/

=== Public media databases (Wikimedia Commons and Dansk Folkemindesamling) ===

We’re have captured images and audio from Wikimedia Commons (downloaded images and audio) and Dansk Folkemindsamling (downloaded audio - not used in the demo and) and during the demo not through an API but using manual downloads.

=== Daells Varehus faxsimiles (not in demo) ===

We know the URL to images from Daells Varehus 

ie http://www.kb.dk/imageService/w600/h600/online_master_arkiv_2/non-archival/PLG/Daellsvarehus/dv1929-30_h/dv1929-30_h_019.jpg

Thus
<pre>
<daells-varehus-image-url> ::= “http://www.kb.dk/imageService/”<width><height>”online_master_arkiv_2/non-archival/PLG/Daellsvarehus/”
<width> ::= “w”<digits>
<height> ::= “h”<digits>
<digits> ::= <digit>{<digit>}
<start-year>”-”<endyear>”_h/dv/”<start-year>”-”<end-year>”_h_”<pagenumber>”.jpg”
<start-year> ::= <digit><digit><digit><digigt>
<end-year> ::= <digit><digit>
<page-number> ::= <digit><digit><digit>
<Y> ::= <digit>
<digit> ::= “0” | “1” | “2” | “3” | “4” | “5” | “6” | “7” | “8” | “9”
</pre>

=== DRs udsendelsesprogrammer (tv/radio) 1925-1989 (not in demo and outside our initial time frame 1890-1924)=== 

http://www.danskkulturarv.dk/programoversigter/ 

== Development (or: “Assumption is the Mother of all FUs!”) ==

First hurdle was that we didn’t get the data that could link an address to a registerblad, with the kind and speedy assistance of the developer we were given new parameters so that we could implement the use case.

We started testing the API, and quickly discovered that the API didn’t suit our use-case. It was promptly modified by the lead-delveloper that was on present during #HACK4DK - this was a godsend and we recommend that the API lead-developers are at hand and pro-actively contact the teams that are working with the data-sets.  

=== Leaflet API (Clickable OpenStreetMap) ===

Click a map, get the location in WGS84

<pre>
<!DOCTYPE html>
<html>
<head>
	<title>OpenDoor</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	</script>

</head>
<body>
	<div id="map" style="width: 600px; height: 400px"></div>
	<script>
		var map = L.map('map');

		L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'examples.map-i875mjb7'
		}).addTo(map);

		function onLocationFound(e) {
			var radius = e.accuracy / 2;

			L.marker(e.latlng).addTo(map)
				.bindPopup("Du er ca. " + radius + " meter fra dette punkt").openPopup();

			L.circle(e.latlng, radius).addTo(map);
		}

		function onLocationError(e) {
			alert(e.message);
		}

		map.on('locationfound', onLocationFound);
		map.on('locationerror', onLocationError);

		map.locate({setView: true, maxZoom: 16});

		var popup = L.popup();

		map.on('click', onMapClick);
</script>
</body>
</html>
</pre>

=== Address Web Service (reverse geocode) ===

From WGS84 to an address

==== Example ====

Poppelgade 1
lat=55.69191292268034&lng=12.559229135513306

Fed to AWS
http://webapi.aws.dk/adresser/55.69191292268034,12.559229135513306.json

Yields

<pre>
{"href":"http:\/\/webapi.aws.dk\/adresser\/0a3f507a-db69-32b8-e044-0003ba298018.json","id":"0a3f507a-db69-32b8-e044-0003ba298018","bygningsnavn":"","vejnavn":{"kode":"5564","navn":"Poppelgade","href":"http:\/\/webapi.aws.dk\/kommuner\/0101\/vejnavne\/5564.json"},"husnr":"1","supplerendebynavn":"","postnummer":{"nr":"2200","navn":"København N","href":"http:\/\/geo.oiorest.dk\/postnumre\/2200.json"},"kommune":{"kode":"0101","navn":"Københavns Kommune","href":"http:\/\/geo.oiorest.dk\/kommuner\/0101.json"},"region":{"nr":"1084","navn":"Region Hovedstaden","href":"http:\/\/geo.oiorest.dk\/regioner\/1084.json"},"landsejerlav":"2000173","ejerlav":{"kode":"2000173","navn":"UDENBYS KLÆDEBO KVARTER, KØBENHAVN","href":"http:\/\/geo.oiorest.dk\/kommuner\/0101\/ejerlav\/2000173.json"},"matrikelnr":"1729","esrejendomsnr":"014444","oprettelsesdato":"2009-11-25T12:00:00","ændringsdato":"","ikraftrædelsesdato":"","etrs89koordinat":{"øst":"723685.74","nord":"6177534.27","oest":"723685.74"},"wgs84koordinat":{"bredde":"55.6919242444808","længde":"12.5591379808066"},"adressepunktnøjagtighed":"A","adressepunktkilde":"5","adressepunkttekniskstandard":"TD","adressepunkttekstretning":"200","KN100mDK":"100m_61775_7236","KN1kmDK":"1km_6177_723","KN10kmDK":"10km_617_72","adressepunktændringsdato":"2002-04-05T12:00:00"}
</pre>

This should only return one address, the closest, and we need the vejnavn.navn (road name) and husnr (number) fields

=== Politiets registerblade (location, time and persons) ===

From address (roadname and number) to registerblade and persons. The API was extended “in-hack” by the developer so that we could specify “number” in the address-service and “registerblad_id” in the person-service. 

==== Example ====
Poppelgade 1

Poppelgade is fed to road-service:
http://www.politietsregisterblade.dk/api/1/?type=road&name=poppelgade&limitstart=0&limit=1

Yields 
<pre>
[{"id":"1708","name":"Poppelgade"}, {"results":1}]
</pre>

road_id 1708 and number 1 is fed to address-service:
http://www.politietsregisterblade.dk/api/1/?type=address&road_id=1708&number=1

Yields:
<pre>
[{"id":"15392","registerblad_id":"1640013","road_id":"1708","roadname":"Poppelgade","number":"1","letter":"","floor":"4.","side":"","place":null,"date":"05-05-1913","latitude":"55.691923700000","longitude":"12.559140200000"}, […losts of data...]
{"results":436}]
</pre>

registerblad_id 1640013 is fed to person-service:
http://www.politietsregisterblade.dk/api/1?type=person&registerblad_id=1640013

Yields:

<pre>
[{"id":"371677","registerblad_id":"1640013","firstnames":"Anna Marie Christine Petra","person_type":"1","lastname":"Erdmann","birthplace":"Middelfart","dateofbirth":"19-06-1891","dateofdeath":null}, {"results":1}]
</pre>

=== Server-based API ===

During initial development we experimented with the APIs using client-side JavaScript, when we finally had that working, we realised that we wanted a server side API, so that was implemented using the Fat-Free Framework for PHP.

This was a major hurdle, but it worked perfectly and is a thing of beauty.

The API is easy to extend.

=== Front-end ===

Developed in Adobe Muse. It proved difficult to integrate the front-end developed in Muse with the API (for instance iframes with dynamically generated <div>-ids!), so we hacked the HTML that was output by Muse.
Integration (putting it all - the backend that is - together) 

=== Original “pure” client-side integration hack for reference (might not work ;-)) ===

<pre>
<html>
<head>
<!DOCTYPE html>
	<title>OpenDoor</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>

	  <!-- <script src="http://code.jquery.com/jquery-1.4.4.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
	    $(function () {
	      var kriterie = {};
	      kriterie['bredde'] = '55.700677';
	      kriterie['længde'] = '12.59074';
	      $.ajax({
	        url: 'http://webapi.aws.dk/adresser.json',
	        data: kriterie,
	        dataType: "jsonp",
	        error: fejlikommunikation,
	        jsonpCallback: 'visadresser'
	      });
	    });

	    function visadresser(adresser) {
	      $.each(adresser, function (i, adresse) {
	        $("#adresser").append("<p>" + adresse.vejnavn.navn + " " + adresse.husnr + " " + adresse.postnummer.nr + " " + adresse.postnummer.navn + "</p>");
	      });
	    }

	    function fejlikommunikation(xhr, status, errorThrown) {
	      $("fejl").append("<p>status: " + status + ", errorThrown: " + errorThrown + "</p>");
	    };

  	</script>


</head>
<body>
	<div id="map" style="width: 600px; height: 400px"></div>
	<script>
		var map = L.map('map');

		L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
				'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="http://mapbox.com">Mapbox</a>',
			id: 'examples.map-i875mjb7'
		}).addTo(map);

		function onLocationFound(e) {
			var radius = e.accuracy / 2;

			L.marker(e.latlng).addTo(map)
				.bindPopup("Du er ca. " + radius + " meter fra dette punkt").openPopup();

			L.circle(e.latlng, radius).addTo(map);
		}

		function onLocationError(e) {
			alert(e.message);
		}

		map.on('locationfound', onLocationFound);
		map.on('locationerror', onLocationError);

		map.locate({setView: true, maxZoom: 16});

		var popup = L.popup();

		function reqListenerAWS () {
			// Parse the AWS reverse geocode search, there should be only one result
			alert (this.responseText);
		}

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("Du klikkede på " + e.latlng.lat + "," + e.latlng.lng)
				.openOn(map);

			var coord = e.latlng;

			getRoad(coord)
			  .then(function(roadJson){
			  	husnr = roadJson.husnr;
			  	console.log(roadJson);
				return getRoadId(roadJson);

			}).then(function(roadIdJson){
				console.log(roadIdJson);
				return getRegisterBlad(roadIdJson[0].id, roadIdJson[0].husnr);

			}).done(function(registerBladJson){
				console.log(registerBladJson);
			});

		}

		map.on('click', onMapClick);

		function getRoad(coordinate) {
			return $.ajax({
				url:"http://webapi.aws.dk/adresser/" + coordinate.lat + "," + coordinate.lng + ".json",
				dataType: 'jsonp', // Notice! JSONP <-- P (lowercase)
				error:function(){
					alert("Error");
				}
			});
		}

		function getRoadId(roadJson) {
			var roadName = roadJson.vejnavn.navn;
			var apiString =
				"http://www.politietsregisterblade.dk/api/1/?type=road&name="+ roadName +"&limitstart=0&limit=1";
			// console.log("Querying: " + apiString);

			var promise = $.ajax({
				url: apiString,
				dataType: "jsonp",
				success: function(json) {
					json[0].husnr = roadJson.husnr;
					return json;
				},
				error: function(err) {
					alert(err);
				}
			});

			return promise;
		}

		function getRegisterBlad(roadId, roadNumber) {
			var apiString = "http://www.politietsregisterblade.dk/api/1/?type=address&road_id=" +
						    roadId + "&number=" + roadNumber;
		    // console.log(apiString);
			var promise = $.ajax({
				url: apiString,
				dataType: "jsonp"

			});

			return promise;
		}

		function getPersonsByRegisterBlad(regId) {
			var apiString = "http://www.politietsregisterblade.dk/api/1/?type=person&registerblad_id=" + regId;
		}


</script>

	  <div id='adresser'>
  </div>
  <div id='fejl'>
  </div>

</body>
</html>
</pre>

=== API-documentation  ===
to-do

== Demo ==

At the presentation we we’re demoing 3 live APIs (Leaflet API for OpenStreetMap, Address Web Service and Registerblade) as well as the display of data in the form os images  downloaded from Wikimedia Commons.

Leaflet-API provided the navigational map the address clicked was reverse-geocoded using Address Web Service and Politiets  Registerblade was then called using a slider to navigate through years.

Access to Address Web Service and Politiets Registerblade took place using a new REST API.
Further development (low-hanging fruits - not sure that works in English :-))
Active clips for Soundclips (Phonograph on table), News (Newspaper on table), Genealogy (Heraldric tree on wall), Weather (The is sun shining outside for instance) Magazines/Catalogues (icon on the table) display of the actual Registerblad (one of the picture frames on the wall) using MediaWiki API to display the image on the Wall instead of using manual download 

== Conclusion ==

We believe that we met the goal of providing a new API that integrated several (for the demo two) services.

We worked closely with the lead-developer of the Registerblade API, that wasn’t  

We had a live demo that used three public APIs and displayed manually scraped data from Wikimedia Commons.

It’s very important that the dataset and API developers are present in-hack, and it was extremly bold that the lead-developer hacked the live server friday to accomodate our use-case. Without that we would not have had a  live demo! 

== Installation ==

There’s a problem with the paths. If you want to run the demo n a local server (LAMP/MAMP/WAMP) it is important that you use this base URL http://<server>/HACK4DK-2014/.

== Testing ==

Browse to http://<server>/HACK4DK-2014/opendoor/osm.html, ie. http://localhost/HACK4DK-2014/opendoor/osm.html

== Post-caluclation ==

Guestimate on amount of time invested in the development of #HACK4DK:OpenDoor:

https://docs.google.com/spreadsheets/d/1Oa6XaXbA22EHvpljbDot9Jk4ti992SmOm7nM7NgCJhs/edit#gid=0

Grand total is 100-150 hours!

== Soundtrack ==

https://www.youtube.com/watch?v=xsvsbLOc2T4

== Afterparty (Anarchy in the #HACK4DK) ==

Reboot of The Sex Pistols, first rehersal at Ølbaren, Elmegade, 2200 København N

Not sure about the “roles” but we’re ready to go on tour.

=== "Band"-members ===

==== Giulio Ungaretti (@giulioungaretti) - head ====

==== Henri Suominen (hsuominen@gmail.com) - head ====

==== Rotten (pun intended if you understand danish) Kim Bach (@kim_bach) - body ====
