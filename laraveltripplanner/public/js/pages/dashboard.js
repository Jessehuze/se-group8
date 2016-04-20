// This function initializes the map
function initMap() {
    // Ensure the map is the right size before we initialize it
    drawMap();

    // Get the mapDiv from the DOM
    var mapDiv = document.getElementById("map");

    // Make a map element using js that is linked
    // from google in the html of this page
    // Passed parameters are random and just to show
    // how to do so
    var map = new google.maps.Map(mapDiv, {
      center: {lat: 44.540, lng: -78.546},
      zoom: 8
    });
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