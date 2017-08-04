 <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 450px;
		width: 100%;
      }
	  #rodape {
        height: 90px;
		width: 100%;
		overflow: auto;
      }
      
	  /* Optional: Makes the sample page fill the window. */
      html, body {
	  	background-color: #f6f6f6;
        height: 565px;
		width: 700px;
        margin: 0;
        padding: 0;
      }
    </style>
    
<div id="cont">
    <div class="content">
        <div class="col-md-12">
            <div class="content">
                <div id="map"></div>
                <div id="rodape"></div>
            </div>
        </div>
    </div>
</div>
<script>

		
      function initMap() {

        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        var styledMapType = new google.maps.StyledMapType(
            [
              {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
              {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
              {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
              {
                featureType: 'administrative',
                elementType: 'geometry.stroke',
                stylers: [{color: '#c9b2a6'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'geometry.stroke',
                stylers: [{color: '#dcd2be'}]
              },
              {
                featureType: 'administrative.land_parcel',
                elementType: 'labels.text.fill',
                stylers: [{color: '#ae9e90'}]
              },
              {
                featureType: 'landscape.natural',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#93817c'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'geometry.fill',
                stylers: [{color: '#a5b076'}]
              },
              {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#447530'}]
              },
              {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#f5f1e6'}]
              },
              {
                featureType: 'road.arterial',
                elementType: 'geometry',
                stylers: [{color: '#fdfcf8'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#f8c967'}]
              },
              {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#e9bc62'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry',
                stylers: [{color: '#e98d58'}]
              },
              {
                featureType: 'road.highway.controlled_access',
                elementType: 'geometry.stroke',
                stylers: [{color: '#db8555'}]
              },
              {
                featureType: 'road.local',
                elementType: 'labels.text.fill',
                stylers: [{color: '#806b63'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.fill',
                stylers: [{color: '#8f7d77'}]
              },
              {
                featureType: 'transit.line',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#ebe3cd'}]
              },
              {
                featureType: 'transit.station',
                elementType: 'geometry',
                stylers: [{color: '#dfd2ae'}]
              },
              {
                featureType: 'water',
                elementType: 'geometry.fill',
                stylers: [{color: '#b9d3c2'}]
              },
              {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#92998d'}]
              }
            ],
            {name: 'Styled Map'});




		var directionsService = new google.maps.DirectionsService();
		var map;
		var haight = "<?=$latitude_partida?>,<?=$longitude_partida?>";
		var oceanBeach = "<?=$latitude_destino?>,<?=$longitude_destino?>";
		
		directionsDisplay = new google.maps.DirectionsRenderer();
  			var mapOptions = {
    		zoom: 14,
    		center: haight
  		}

		map = new google.maps.Map(document.getElementById('map'), mapOptions);
  		
  		

        var request = {
     		 origin: haight,
      		 destination: oceanBeach,
      		  travelMode: google.maps.TravelMode["DRIVING"]
  		};
  		directionsService.route(request, function(response, status) {
    			if (status == 'OK') {
						//console.log(response);
						var tempo_percurso = "<b>Tempo de trajeto previsto:</b> "+response.routes[0].legs[0].duration.text;
						var distancia = "<b>Distância do trajeto:</b> "+response.routes[0].legs[0].distance.text;
						
						var trajeto = "<b>Trajeto:</b></br>";
						var tamanho = response.routes[0].legs[0].steps.length;
						for(var cont = 0; cont < tamanho; cont++) {
							
							trajeto += response.routes[0].legs[0].steps[cont].instructions+"<br>";

						}
						
						document.getElementById("rodape").innerHTML = distancia+"<br>"+tempo_percurso+"<br>"+trajeto;
      					directionsDisplay.setDirections(response);
    			}else {
						alert("Endereço destino não localizado ou inválido");
						top.window.jNo.close();
				}
  		});

	{Maker}

        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
		directionsDisplay.setMap(map);
		
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIYKhw-g_fYQKSae3nF5mQeEOEyhdDDiE&callback=initMap" async defer></script>