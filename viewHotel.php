<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>India at a Glance</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
<link rel="stylesheet" href="style.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&region=IN"></script>
<script type="text/javascript" src="ui/jquery.ui.map.js"></script>
<script type="text/javascript" src="ui/jquery.ui.map.services.js"></script>
<script type="text/javascript" src="ui/jquery.ui.map.extensions.js"></script>
</head>
<body>
<div data-role="page" id="page1">
	 <div data-theme="a" data-role="header">
	 <h1 class="search_hotel_icon">Available Hotels</h1>
	        <div data-role="navbar" data-iconpos="top">
	            <ul>
	                <li>
	                    <a href="index.html" data-transition="fade" data-theme="" data-icon="home">
	                        Home
	                    </a>
	                </li>
	                <li>
	                    <a href="about.html" data-transition="fade" data-theme="" data-icon="info">
	                        About
	                    </a>
	                </li>
	                <li>
	                    <a href="feedback.php" data-transition="fade" data-theme="" data-icon="star">
	                        Feedback
	                    </a>
	                </li>
	            </ul>
	        </div>
	    </div>
    <div data-role="content">
      <div id="directions_map">
  				<div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
  					<div id="map_canvas_1" style="height:300px;"></div>
  					<p>
  						<label for="from">From</label>
  						<input id="from" class="ui-bar-c" type="text" value="" />
  					</p>
  					<p>
  						<label for="to">To</label>
  						<input id="to" class="ui-bar-c" type="text" value="<?php print urldecode($_REQUEST['id']); ?>" disabled="disabled"/>
						<input id="to_latlng" class="ui-bar-c" type="hidden" value="<?php print urldecode($_REQUEST['lat']); ?>,<?php print urldecode($_REQUEST['lng']); ?>" disabled="disabled"/>
  					</p>
  					<a id="submit" href="#" data-role="button" data-icon="search">Get directions</a>
  				</div>
  				<div id="results" class="ui-listview ui-listview-inset ui-corner-all ui-shadow" style="display:none;">
  					<div class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-top ui-btn-up-undefined">Results</div>
  					<div id="directions"></div>
  					<div class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-bottom ui-btn-up-undefined"></div>
  				</div>
  		</div>
	  </div>
	    <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
            &copy; 2013, Team Neophytes.
        </h3>
    </div>
</div>
<script>
(function($) {
	  $(function() {
			  var hotelview = { 'center': '<?php print urldecode($_REQUEST['lat']); ?>,<?php print urldecode($_REQUEST['lng']); ?>', 'zoom': 10 };
	  		  	$('#map_canvas_1').gmap({'center': hotelview.center, 'zoom': hotelview.zoom, 'disableDefaultUI':true, 'callback': function() {
	  		  		var self = this;
	  		  		self.addMarker({'position': this.get('map').getCenter() }).click(function() {
	  		  		  self.openInfoWindow({ 'content': '<?php print urldecode($_REQUEST['id']); ?>' }, this);
	  					  });
	  		  		$('#submit').click(function() {
	  		  			self.displayDirections({ 'origin': $('#from').val(), 'destination': $('#to_latlng').val(), 'travelMode': google.maps.DirectionsTravelMode.DRIVING }, { 'panel': document.getElementById('directions')}, function(response, status) {
	  		  				( status === 'OK' ) ? $('#results').show() : $('#results').hide();
	  		  			});
	  		  			return false;
	  		  		});
	  		  	}});
	  		  	getCurrentLoc();			  
	  });
	})(jQuery);
//Get user location
function getCurrentLoc() {
  // Try HTML5 geolocation
	  if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		   geocoder = new google.maps.Geocoder();
		   var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			geocoder.geocode({'latLng': latlng}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
		  if (results[1]) {
			document.getElementById('from').value = results[1]['formatted_address'];
		  } else {
			alert('No results found');
		  }
		} else {
		  alert('Geocoder failed due to: ' + status);
		}

	  });
	});
	}
}
</script>
</body>
</html>
