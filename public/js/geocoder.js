				  var geocoder;
				  var map;
				  
				  function initMap() {
				    geocoder = new google.maps.Geocoder();
				    var latlng = new google.maps.LatLng(-2.889074,-79.011777);
				    var mapOptions = {
				      zoom: 20,
				      center: latlng,
				    }
				    map = new google.maps.Map(document.getElementById('map'), mapOptions);
				   // Crea la ventana de información inicial.
				  var infoWindow = new google.maps.InfoWindow (
				      {contenido: 'Haga clic en el mapa para obtener Lat / Lng!', position: latlng});
				  infoWindow.open (map);

				  // Configure el escucha de clics.
				  map.addListener ('click', function (mapsMouseEvent) {
				    // Cierre la ventana de información actual.
				    infoWindow.close ();

				    // Cree una nueva ventana de información.
				    infoWindow = new google.maps.InfoWindow ({position: mapsMouseEvent.latLng});
				    infoWindow.setContent (mapsMouseEvent.latLng.toString ());
				    $("#pgeoposicion").val(mapsMouseEvent.latLng.toString ());
				    infoWindow.open (map);
				  });
				  }



				  function codeAddress() {
				    var address = document.getElementById('pdireccion').value;
				    geocoder.geocode( { 'address': address}, function(results, status) {
				      if (status == 'OK') {
				        map.setCenter(results[0].geometry.location);
				        var marker = new google.maps.Marker({
				            map: map,
				            position: results[0].geometry.location
				            
				        });
				        

				        alert(results[0].formatted_address);
				        $("#pgeoposicion").val(results[0].geometry.location);
				       
      					
				      } else {
				        alert('Geocode was not successful for the following reason: ' + status);
				      }
				    });
				  }



				