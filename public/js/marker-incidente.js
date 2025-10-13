				  
				  let map;
				  const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				  let labelIndex = 0;
				  
		
				  let tabla = $('#incidente').val();
	   			  let fechad = $('#fechad').val();
			 	  let fechah = $('#fechah').val();	  
				   let mygeo;
				  function initMap() {
					let mydata;
					let marker;
					let latlngc = new google.maps.LatLng(-2.897741, -79.004580);
					$.get('googlemymapsjson/' + tabla +','+ fechad +','+ fechah, function(data) {
						
						
						mydata = JSON.parse(data); 
						let mapOptions = {
							zoom: 13,
							center: latlngc,
							streetViewControl: false,
							mapTypeId: "satellite",
							mapTypeControlOptions: {
							mapTypeIds: ["satellite", "roadmap"],
							style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
							},
						}
						map = new google.maps.Map(document.getElementById('map'), mapOptions);
						
						const svgMarker = {
							path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
							fillColor: "red",
							fillOpacity: 0.7,
							strokeWeight: 0,
							rotation: 0,
							scale: 1.5,
							anchor: new google.maps.Point(1, 15),
						};
						cant = [].concat.apply([], mydata).length;
						for(i=0;i<cant;++i){
							
							mygeo = mydata[i].geoposicion;
							
							posicioni = mygeo.indexOf('('); 
							posicionf = mygeo.lastIndexOf(',');
							mygeof = mygeo.slice(posicioni+1,posicionf);
							mygeof = mygeof.slice(0);
							lat = parseFloat(mygeof);
							posicionf2 = mygeo.lastIndexOf(')');
							mygeo = mygeo.slice(posicionf+1,posicionf2);
							long =parseFloat(mygeo);
							let latlng = new google.maps.LatLng(lat,long);
							
							const image = "/images/fire.png";
							const content =
								'<div id="content">' +
								'<div id="siteNotice">' +
								"</div>" +
								'<div id="bodyContent">' +
								"<table class='table-hover table-sm table-condensed'>"+
								'<thead>'+
								'<tr class="table-info">'+
								"<th>Fecha</th>"+
								"<th>Address</th>"+
								'</tr>'+
								'</thead>'+
								'<tbody>'+
								'<tr>'+
								"<td>"+mydata[i].fecha+"</td>"+
								"<td>"+mydata[i].direccion+"</td>"+	
								"</tr>"+
								'</tbody>'+
								'<tfoot>'+
								'</tfoot>'+
								"</table>"+
								"<table class='table-hover table-sm table-condensed'>"+
								'<thead>'+
								'<tr class="table-info">'+
								"<th>Informacion_inicial</th>"+
								"<th>Detalle_emergencia</th>"+
								'</tr>'+
								'</thead>'+
								'<tbody>'+
								'<tr>'+
								"<td>"+mydata[i].informacion_inicial+"</td>"+
								"<td>"+mydata[i].detalle_emergencia+"</td>"+
								"</tr>"+
								'</tbody>'+
								'<tfoot>'+
								'</tfoot>'+
								"</table>"+
								"</div>" +
								"</div>";
								
								marker = new google.maps.Marker({
									map: map,
									position: latlng,
									title: "Incidente",
									icon: image,
								});
		
								/* const infowindow = new google.maps.InfoWindow({
									content: contentString,
								  }); */
								  const infoWindow = new google.maps.InfoWindow();
								marker.addListener("click", (event) => {
									infoWindow.setContent(content);
									infoWindow.setPosition(latlng);
									infoWindow.setOptions({pixelOffset: new google.maps.Size(0, -30)});
									infoWindow.open(map);
								  });
						}					
					});
					
				}

				  

				  
				 

				  
      




				