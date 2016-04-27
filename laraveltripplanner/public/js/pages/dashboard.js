// Some global variables (there are others)
waypts = [];
markers = [];
placeArray = [];


// This function is called via callback when the google js file is loaded
function initFunc() {
    initMap();
    initSearch();
}

// This function initializes the map
function initMap() {
    // Ensure the map is the right size before we initialize it
    sizeMap();


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

    // Instantiate a directions service.
    directionsService = new google.maps.DirectionsService;

    // Create a renderer for directions and bind it to the map.
    directionsDisplay = new google.maps.DirectionsRenderer({map: map});

    // Instantiate an info window to hold step text.
    stepDisplay = new google.maps.InfoWindow;

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, map.getCenter());
        });
    }

    // Bias the SearchBox results towards places that are within the bounds of the
    // current map's viewport.
    google.maps.event.addListener(map, 'bounds_changed', function() {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
    });
}

// This function initializes the searchbox
function initSearch() {
    searchDiv = document.getElementById("map-input");

    // GLOBAL VARIABLE
    searchBox = new google.maps.places.SearchBox((searchDiv));
    searchService = new google.maps.places.PlacesService(map);
    geocoder = new google.maps.Geocoder();

    // Listen for the event fired when the user selects an item from the
    // pick list. Retrieve the matching places for that item.
    google.maps.event.addListener(
        searchBox, 'places_changed', function() {
            places = searchBox.getPlaces();

            // Check to make sure there was a result.
            if (places.length == 0) {
                return;
            }

            // Check to make sure the result isn't already in the list
            duplicate = false;
            for(i=0; i < placeArray.length; i++) {
                if(placeArray[i].place_id == places[0].place_id) {
                    duplicate = true;
                    alert('That item is already in the list');
                }
            }

            if(duplicate == false) {
                // Add the place to the array
                placeArray.push(places[0]);
                var index = placeArray.length-1;

                // Add the place to the waypoint input
                waypointList = document.getElementById("waypoints");
                waypointList.value += (places[0].formatted_address + ";");

                // Clear out the old markers.
                for (var i = 0, marker; marker = markers[i]; i++) {
                    marker.setMap(null);
                }

                // For each place, get the icon, place name, and location.
                markers.length = 0;
                var bounds = new google.maps.LatLngBounds();

                for (var i = 0, place; place = placeArray[i]; i++) {
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

                var id = placeArray[index].name + markers.length
                document.getElementById("routes").insertAdjacentHTML(
                    "beforeend", "<div class=\"location\" id=\""
                    + id
                    + "\">"
                    + "<button class=\"btn-danger deleteLocation\""
                    + "onclick=\"removeWaypoint("
                    + "'" + id + "'"
                    + "," + "'" + placeArray[index].name + "'"
                    + ");\">X</button>"
                    + "  "
                    + placeArray[index].name
                    + "</div>");

                calculateAndDisplayRoute(
                    directionsDisplay, directionsService, markers, stepDisplay, map);
                map.fitBounds(bounds);
            }
        }
    );
}

// This function sizes the map to be the full background of the page
function sizeMap() {
  var mapDiv = document.getElementById("map");
  mapDiv.style.width = (document.documentElement.clientWidth) + "px";
  mapDiv.style.height = (document.documentElement.clientHeight - 55)+ "px";
}

// This listener handles redrawing the map
// when the window is resized
window.addEventListener(
  "resize", function() {
      sizeMap();
  }
);


function calculateAndDisplayRoute(directionsDisplay, directionsService,
    markerArray, stepDisplay, map) {
    for(i=1; i < placeArray.length - 1; i++) {
        waypts.push({
            location: placeArray[i].formatted_address,
            stopover: true
          });
    }
    // First, remove any existing markers from the map.
    for (var i = 0; i < markerArray.length; i++) {
        markerArray[i].setMap(null);
    }
    if (markers.length > 1) {
        // Retrieve the start and end locations and create a DirectionsRequest
        directionsService.route({
            origin: markers[0].position,
            destination: markers[markers.length -1].position,
            waypoints: waypts,
            optimizeWaypoints: false,
            travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
            // Route the directions and pass the response to a function to create
            // markers for each step.
            if (status === google.maps.DirectionsStatus.OK) {
                document.getElementById('warnings-panel').innerHTML =
                    '<b>' + response.routes[0].warnings + '</b>';
                directionsDisplay.setDirections(response);
                showSteps(response, markerArray, stepDisplay, map);
            } else {
                window.alert('Directions request failed due to ' +
                    status);
            }
        });
    }
}

function showSteps(directionResult, markerArray, stepDisplay, map) {
    // For each step, place a marker, and add the text to the marker's infowindow.
    // Also attach the marker to an array so we can keep track of it and remove it
    // when calculating new routes.
    var myRoute = directionResult.routes[0].legs[0];
    for (var i = 0; i < myRoute.steps.length; i++) {
        var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
        marker.setMap(map);
        marker.setPosition(myRoute.steps[i].start_location);
        attachInstructionText(stepDisplay, marker, myRoute.steps[i].instructions,
            map);
    }
}

function attachInstructionText(stepDisplay, marker, text, map) {
    google.maps.event.addListener(marker, 'click', function() {
        // Open an info window when the marker is clicked on, containing the text
        // of the step.
        stepDisplay.setContent(text);
        stepDisplay.open(map, marker);
    });
}

function removeWaypoint(id, placeName) {
    waypts.length = 0;
    var element = document.getElementById(id);

    element.parentNode.removeChild(element);

    for (i=0; i < placeArray.length; i++) {
        if (placeArray[i].name == placeName) {
            placeArray.splice(i, 1);
        }
    }

    drawMap();
}

var active = undefined;

function sidebarClick(divObj) {
  if(active != undefined) {
    active.id="";
  }
  active = divObj;
  active.id="active-route";
}

function loadMap(locations) {
    // Param: locations, [string1, string2]
    //      Contains addresses of the locations for the
    //      map to be loaded

    waypts.length = 0;
    placeArray.length = 0;

    document.getElementById('routes').innerHTML = '';

    for(i=0; i<locations.length-1; i++) {
        geocoder.geocode(
            { 'address': locations[i]}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    searchService.getDetails(
                        {placeId: results[0].place_id}, function(results, status) {
                            if (status == google.maps.places.PlacesServiceStatus.OK) {
                                placeArray.push(results)
                            }
                        });
                }
            });
    }

    geocoder.geocode(
            { 'address': locations[locations.length-1]}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    searchService.getDetails(
                        {placeId: results[0].place_id}, function(results, status) {
                            if (status == google.maps.places.PlacesServiceStatus.OK) {
                                placeArray.push(results)
                                for(i=0; i < placeArray.length; i++) {
                                    var id = placeArray[i].name + markers.length
                                    document.getElementById("routes").insertAdjacentHTML(
                                        "beforeend", "<div class=\"location\" id=\""
                                        + id
                                        + "\">"
                                        + "<button class=\"btn-danger deleteLocation\""
                                        + "onclick=\"removeWaypoint("
                                        + "'" + id + "'"
                                        + "," + "'" + placeArray[i].name + "'"
                                        + ");\">X</button>"
                                        + "  "
                                        + placeArray[i].name
                                        + "</div>");
                                }
                                drawMap();
                            }
                        });
                }
            });


}

function drawMap() {
    // Clear out the old markers.
    for (var i = 0, marker; marker = markers[i]; i++) {
        marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers.length = 0;
    var bounds = new google.maps.LatLngBounds();
    var index = 0;
    for (var i = 0, place; place = placeArray[i]; i++) {
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

    calculateAndDisplayRoute(
        directionsDisplay, directionsService, markers, stepDisplay, map);
    map.fitBounds(bounds);
}

