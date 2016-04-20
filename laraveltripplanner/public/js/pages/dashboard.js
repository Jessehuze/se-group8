// This function is called via callback when the google js file is loaded
function init() {
    initMap();
    initSearch();
}

// This function initializes the map
function initMap() {
  // Ensure the map is the right size before we initialize it
  drawMap();


    // Get the mapDiv from the DOM
    mapDiv = document.getElementById("map");

    // GLOBAL VARIABLE
    // Make a map element using js that is linked
    // from google in the html of this page
    // Passed parameters are random and just to show
    // how to do so
    map = new google.maps.Map(mapDiv, {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: {lat: 37.9565204, lng: -91.7768474},
      zoom: 15
    });



    // Bias the SearchBox results towards places that are within the bounds of the
    // current map's viewport.
    google.maps.event.addListener(map, 'bounds_changed', function() {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
    });
}

// This function initializes the searchbox
function initSearch() {
    var input = document.getElementById("map-input");
    markers = [];

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // GLOBAL VARIABLE
    searchBox = new google.maps.places.SearchBox((input));

    // Listen for the event fired when the user selects an item from the
    // pick list. Retrieve the matching places for that item.
    google.maps.event.addListener(
        searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                var image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                var marker = new google.maps.Marker({
                    map: map,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location
                });

                markers.push(marker);

                bounds.extend(place.geometry.location);
            }

            map.fitBounds(bounds);
        }
    );
}

// This function sizes the map to be the full background of the page
function drawMap() {
  var mapDiv = document.getElementById("map");
  mapDiv.style.width = (document.documentElement.clientWidth) + "px";
  mapDiv.style.height = (document.documentElement.clientHeight - 55)+ "px";
}

// This listener handles redrawing the map
// when the window is resized
window.addEventListener(
  "resize", function() {
      drawMap();
  }
);

var active = undefined;

function sidebarClick(divObj) {
  if(active != undefined) {
    active.id="";
  }
  active = divObj;
  active.id="active-route";
}

// This function draws a route on the map
function drawRoute() {
    calculateAndDisplayRoute(
        directionsDisplay, directionsService, markerArray, stepDisplay, map);
}
