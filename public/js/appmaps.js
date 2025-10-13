				  
				  function initMap() {
					// Create the map.
					const map = new google.maps.Map(document.getElementById('map'), {
					  zoom: 7,
					  center: {lat: -2.897741, lng: -79.004580},
					});
				  
					// Load the stores GeoJSON onto the map.
					map.data.loadGeoJson({{$busquedaentrefechas}}, {idPropertyName: 'storeid'});
				  
				
					const infoWindow = new google.maps.InfoWindow();
				  
					// Show the information for a store when its marker is clicked.
					map.data.addListener('click', (event) => {
					  const id = event.getProperty('id');
					  const fecha = event.getProperty('fecha');
					  const nombre_incidente = event.feature.getProperty('nombre_incidente');
					  const direccion = event.feature.getProperty('direccion');
					  const nombre = event.feature.getProperty('nombre');
					  const geoposicion = event.feature.getProperty('geoposicion');
					  const position = event.feature.getGeometry().get();
					  const content = `
						<h2>${fecha}</h2><p>${geoposicion}</p>
						<p><b>Open:</b> ${nombre}<br/><b>Phone:</b> ${nombre_incidente}</p>
					  `;
				  
					  infoWindow.setContent(content);
					  infoWindow.setPosition(position);
					  infoWindow.setOptions({pixelOffset: new google.maps.Size(0, -30)});
					  infoWindow.open(map);
					});
				  }
				  

				  
				 

				  
      




				