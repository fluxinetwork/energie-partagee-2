// Init the google map
function initGoogleMap(){
	
	var mapContainer = document.getElementById("map");
	
	var latlng = new google.maps.LatLng(47.50,2.20);
	
	var mapOptions = {
        zoom: 6,
        scrollwheel: false,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        },
        mapTypeControl: false,
        streetViewControl: false,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    };	
		
	var map = new google.maps.Map(mapContainer,mapOptions);		
	
	
	
	loadMarkers(map);
}
// Load markers by JSON ajax custom request
function loadMarkers(map){	

	var str = 'action=get_json_map';
	
	$.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
			
			$.each(data, function(i){	
			
				var newLatLng = {lat: parseInt(data[i].latitude), lng: parseInt(data[i].longitude)};				
							
				var marker = new google.maps.Marker({
					position: newLatLng,
					map: map,
					title: data[i].title
				});				
				
				var markerContent = '<h1>'+data[i].title+'</h1>';
				markerContent += '<a hre="'+data[i].permalink+'">Consulter le projet</a>';
				
				marker.addListener('click', function() {
					onClickMarker(markerContent);
				});

        	});	
			
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false; 
	
}
// Event on click  on a marker
function onClickMarker(markerContent){	
	$('.fluxi-content').append(markerContent);
}

