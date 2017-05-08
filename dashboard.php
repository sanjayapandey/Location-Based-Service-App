<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LSB System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">  
  <link rel="stylesheet" href="css/bookstore.css">
  <link rel="stylesheet" href="css/my-css.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/skins/_all-skins.min.css">
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZV-n2-dX0bq8XbgP6Wp16jHUa7BJIOI4&callback=initMap"
  type="text/javascript"></script>
<script>
$(document).ready(function(){
var  GF;
    if ( navigator.geolocation ) 
     navigator.geolocation.getCurrentPosition( showPosition, showError );
    else
     console.log("Geolocation is not supported by this browser.");
  

   function  showPosition( position ) {
    GF = new google.maps.LatLng( position.coords.latitude, position.coords.longitude);
    console.log("Latitude: "  + position.coords.latitude); 
    console.log("Longitude: " + position.coords.longitude);
   }

   function  showError( error ) {
   console.log(error.code);
   }



	$('#start').autocomplete({
	source: 'serviceFrom.php',
	change: function (event, ui) { 
		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map_canvas'), {
		  zoom: 7,
		  center: {lat: 41.85, lng: -87.65}
		});
		directionsDisplay.setMap(map);
		calculateAndDisplayRoute(directionsService, directionsDisplay);
	}
	});

	$('#end').autocomplete({
	    source: 'serviceTo.php',
	change: function (event, ui) { 
		var directionsService = new google.maps.DirectionsService;
		var directionsDisplay = new google.maps.DirectionsRenderer;
		var map = new google.maps.Map(document.getElementById('map_canvas'), {
		  zoom: 7,
		  center: {lat: 41.85, lng: -87.65}
		});
		directionsDisplay.setMap(map);
		calculateAndDisplayRoute(directionsService, directionsDisplay);
	}
	});
});
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
	var  GF = new google.maps.LatLng( 47.92525699999999, -97.032855 );
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 7,
          center: GF
        });
        directionsDisplay.setMap(map);

      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {       
	directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            //window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>

</head>
<body>
<div id="wrapper">
 <!-- Sidebar -->
        
</div>
<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-7">
				<div class="login-logo">
					<b>LBS </b>System
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-10">
				<ul class="nav nav-tabs">
				  <li class="active"><a href="dashboard.php">GET DIRECTION</a></li>
				  <li><a href="suggestion.php">NEARBY PLACES</a></li>
				</ul>
			</div>
		</div>
		<!-- Small boxes (Stat box) -->
		  <div class="row">
			<div class="col-sm-4">
				<div id="sidebar-wrapper">
					
				</div>
			</div>
			<div class="col-sm-8">
				<div id="custom-search-input">
					<div class="input-group col-md-12 form-group">
						<div class="col-sm-4">
					 		<label>Origin:</label>
					
							<input id="start" class="form-control"/>
						</div>
						<div class="col-sm-4">
						   <label>Destination:</label>
							<input id="end" class="form-control"/>&nbsp;
						</div>
						<div class="col-sm-2">
							<br>
							<input type="submit" class="btn btn-primary" name="" value="Get Path">
							<br> <br>
						</div>
					</div>
				</div>
			</div>
		  </div>
		<div class="row">
				
				<div class="col-sm-12">
						<div id="map_canvas" style="width:96%;height:400px"></div>
				</div>
		</div>
</div>
</body>
</html>
