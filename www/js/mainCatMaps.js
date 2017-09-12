//google map object
var map;
//google map cat markers array
var markers = [];
//pointer to a location on the map (for adding a new cat)
var mapPointer;
//google map marker clusterer object
var markerCluster;
//google map info window for displaying cat details
var infowindow;

var defaultCatIconUrl = "../CatMap/www/images/icons/cat-icon-32.png";

var markerDefaultImage;

//dummy initializing of default starting location
//TODO: replace with web service initialization
  var starting_lat = 49.762896; //pilsen lattitude
  var starting_lng = 13.379735; //pilsen longitude

//array with cat locations
var cats = [];
  
//Ajax initialization of the cat markers                             
$.nette.ajax({
            url: '{link getCats!}',
            type: "GET",

            contentType: 'application/json; charset=utf-8',
            success: function(resultData) {
                //alert(JSON.stringify(resultData));
                //var jsonData = JSON.parse(resultData);
                for (var i = 0; i < resultData.length; i++) {
                    //alert(resultData[i].lat + " " + resultData[i].lng);
                    cats.push({lat:resultData[i].lat, lng:resultData[i].lng, id:resultData[i].id, name:resultData[i].name});
                }
                
                createCatmarkers(); 
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert('Nastala chyba při komunikaci se serverem. Zkuste stránku načíst znovu.');
            },

            timeout: 12000,
        });
  
                             

    //initialization of the google map. function is called via callback 
    function initialize() {
	markerDefaultImage = new google.maps.MarkerImage(defaultCatIconUrl);  
	map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: starting_lat, lng: starting_lng},
	  zoom: 13
	});
        
        //init empty infowindow
        infowindow = new google.maps.InfoWindow();            
  
        //This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
          addMapPointer(event.latLng);
        });
  
    }
  
  //Adds a marker to the map and push to the array.
  function addMarker(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: map,
      icon: markerDefaultImage
    });
    if (markerCluster) {
  	  markerCluster.clearMarkers();
  	}
    markers.push(marker);
    markerCluster = new MarkerClusterer(map, markers);
  }
  
  //Activates a map pointer
  function addMapPointer(location) {
    if (mapPointer) {
        mapPointer.setMap(null);
    }
    else {
        $('#addNewCatArea .alert').hide();
        $('#catFormSubmit').removeAttr('disabled');
    }
    
    //setting location data to hidden form fields
    $('#addNewCatArea #catLat').val(location.lat());
    $('#addNewCatArea #catLng').val(location.lng());
    
    mapPointer = new google.maps.Marker({
      position: location,
      map: map
    });
  }

function createCatmarkers() {
  for (var i = 0; i <= cats.length-1; i++) {
    var latitude = parseFloat(cats[i]["lat"]);
    var longitude = parseFloat(cats[i]["lng"]);
    var newLatLng = {lat: latitude, lng: longitude};
    var id = cats[i]["id"];
    
    var marker = new google.maps.Marker({
    	id: id,
        position: newLatLng,
        map: map,
        icon: markerDefaultImage,
        title: cats[i]["name"]
    });
    
    marker.addListener('click', function() {
        //map.setZoom(16);
        map.setCenter(this.getPosition());
        //TODO: implement proper something :}
        //alert(this.id);
        showCatInfo(this);
    });
    
    markers.push(marker);
  }
  
  markerCluster = new MarkerClusterer(map, markers);
  
}

//displays empty infowindow and calls Ajax function for getting
//cat details and fill to infoWindow object
function showCatInfo(marker) {
    infowindow.close();
    infowindow.setContent("");
    infowindow.open(map, marker);
    getCatDetailAjax(marker);
}

//
function getCatDetailAjax(marker) {
    $.nette.ajax({
            url: '?do=getCatDetails&catId=' + marker.id,
            //url : '{link {$getCatDetailsAjax}! catId => "1"}',
            type: "GET",

            contentType: 'application/json; charset=utf-8',
            success: function(resultData) {
                infowindow.setContent(resultData); 
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert('Nastala chyba při komunikaci se serverem. Zkuste stránku načíst znovu.');
            },

            timeout: 12000,
        });
}

//listener for new cat button - showing the new cat form
$( ".btn-hero" ).click(function() {
    $('#addNewCatArea').show(400);
});

//});

///////////////////////////// FUNCTION LIST ------------------------------------------------------------------------------
