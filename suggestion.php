<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LSB System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOQs5udhpyHrk6D6abirIpYTQFlOCQqNQ&libraries=places&callback=initMap"></script>
<script>
var map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map_canvas'), {
    zoom: 14
  });

  if (navigator.geolocation) {
	  pos = {
		        lat: 47.9251237,
		        lng: -97.08498929999999
		      };
		      console.log(pos);
		      map.setCenter(pos);
		      getNearbyPlaces(pos, map);
//     navigator.geolocation.getCurrentPosition(function(position) {
//       pos = {
//         lat: position.coords.latitude,
//         lng: position.coords.longitude
//       };
//       console.log(pos);
//       map.setCenter(pos);
//       getNearbyPlaces(pos, map);
//     }, function() {
//       handleLocationError(true, infoWindow, map.getCenter());
//     });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }

}

function getNearbyPlaces(location, map) {
var place = document.getElementById('place').value;
  var request = {
    location: location,
    radius: 100000,
    type: [place]
  };
  infowindow = new google.maps.InfoWindow();
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);

  function callback(results, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }
	processResults(results,status);
    }
  }
}

function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: placeLoc
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}

function processResults(results, status) {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
          return;
        } else {
          createMarkers(results);

        }
      }

      function createMarkers(places) {
	
        var bounds = new google.maps.LatLngBounds();
        var placesList = document.getElementById('places');
        placesList.innerHTML="";
        for (var i = 0, place; place = places[i]; i++) {
          var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
          };

          var marker = new google.maps.Marker({
            map: map,
            icon: image,
            title: place.name,
            position: place.geometry.location
          });
          if(isNaN(place.rating))
              continue;
		var content = '<li class="place-description" id='+place.id+'>'+ place.name+' <span class="btn btn-circle btn-primary">'+place.rating+
		'</span></li>';
          placesList.innerHTML += content;
        //onlick event listener for view detail of place
      	$('.place-description').on('click',function(){
      		showPlace(this.id);		  
      	});
          bounds.extend(place.geometry.location);
        }
        map.fitBounds(bounds);
      }
      function showPlace( str ) {

    	  if ( str == "" ) {
    	    document.getElementById("place-detail").innerHTML = "";
    	    return;
    	  }
    	  if ( window.XMLHttpRequest ) {
    	    // code for IE7+, Firefox, Chrome, Opera, Safari
    	    xmlhttp = new XMLHttpRequest( );
    	  }
    	  else {
    	    // code for IE6, IE5
    	    xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
    	  }
    	  xmlhttp.onreadystatechange = function( ) {
    	    if ( ( xmlhttp.readyState == 4 ) && 
    	         ( xmlhttp.status     == 200 ) ) { 
    	      document.getElementById("place-detail").innerHTML = 
    	        xmlhttp.responseText;
    	    }
    	  }
    	  xmlhttp.open( "GET", "getPlaceDetail.php?q="+str, true );
    	  xmlhttp.send( );
    	}

$(document).ready(function(){
	$('#place').autocomplete({
	source: 'placesService.php',
	change: function (event, ui) { 
		console.log("changed place");
		initMap();
	}
	});

	$('#position').autocomplete({
	    source: 'serviceTo.php',
	change: function (event, ui) { 
		console.log("find here:");
	}
	});

})
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
				  <li><a href="dashboard.php">GET DIRECTION</a></li>
				  <li class="active"><a href="#">NEARBY PLACES</a></li>
				</ul>
			</div>
		</div>
		<!-- Small boxes (Stat box) -->
		  <div class="row">
			<div class="col-sm-4">
				<div id="sidebar-wrapper">
					<h3>Nearby suggestion</h3>
					<hr>
				</div>
			</div>
			<div class="col-sm-8">
				<div id="custom-search-input">
					<div class="input-group col-md-12 form-group">
						<div class="col-sm-4">
					 		<label>Looking For:</label>
							<input id="place"  class="form-control" value="resturant"/>
						</div>
						<div class="col-sm-4">
						   <label>Near By:</label>
							<input id="position" class="form-control" value="Current Map View"/>&nbsp;
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
				<div class="col-sm-4">
					<div id="sidebar-wrapper">
						<div id="places" style="height: 400px; scrollable:true;"></div>
					</div>
				</div>
				<div class="col-sm-8">
						<div id="map_canvas" style="width:96%;height:400px"></div>
				</div>
				
		</div>
		<div class="row">
				<div class="col-sm-4">
					<div id="sidebar-wrapper">
						
					</div>
				</div>
			
				<div class="col-sm-8">
						<div id="place-detail" style="margin-top:10px;">
							
						</div>
				</div>
		</div>
</div>
</body>
</html>
