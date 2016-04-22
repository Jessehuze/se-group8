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
    markers = [];
    placeArray = [];
    
    // GLOBAL VARIABLE
    searchBox = new google.maps.places.SearchBox((searchDiv));

    // Listen for the event fired when the user selects an item from the
    // pick list. Retrieve the matching places for that item.
    google.maps.event.addListener(
        searchBox, 'places_changed', function() {
            places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Add the place to the array
            placeArray.push(places[0]);
            var index = placeArray.length-1;

            // Clear out the old markers.
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            // For each place, get the icon, place name, and location.
            markers = [];
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
                + "," + index
                + ");\">X</button>"
                + "  "
                + placeArray[index].name
                + "</div>");

            calculateAndDisplayRoute(
                directionsDisplay, directionsService, markers, stepDisplay, map);
            map.fitBounds(bounds);
        }
    );
}

// This function sizes the map to be the full background of the page
function drawMap() {
    // Get the mapDiv from the DOM
    mapDiv = document.getElementById("map");
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

function calculateAndDisplayRoute(directionsDisplay, directionsService,
    markerArray, stepDisplay, map) {
    
    waypts = [];
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

function removeWaypoint(id, index) {
    waypts = [];
    var element = document.getElementById(id);

    element.parentNode.removeChild(element);
    if (index > -1) {
        placeArray.splice(index, 1);
    }

    // Clear out the old markers.
    for (var i = 0, marker; marker = markers[i]; i++) {
        marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
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