<p id="demo"></p>

<script>
            var timer = setTimeout(function () {
                window.location = 'orders.php'
                var finaltimer = timer + timer
            }, 40000000);
</script>

<script>
setInterval(displayHello, 1000);

function displayHello() {
  document.getElementById("demo").innerHTML += finaltimer;
}
</script>

<h1>The Window Navigator Object</h1>
<h2>The The geolocation Property</h2>

<p id="demo1"></p>

<script>
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
} else { 
  document.getElementById("demo1").innerHTML =
  "Geolocation is not supported by this browser.";
}

function showPosition(position) {
  document.getElementById("demo1").innerHTML =
  "Latitude: " + position.coords.latitude + "<br>" +
  "Longitude: " + position.coords.longitude;
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    // document.write(latitude);
    console.log(latitude);
}
</script>

<script>
    var map;
var service;
var infowindow;

function initMap() {
  var sydney = new google.maps.LatLng(-33.867, 151.195);

  infowindow = new google.maps.InfoWindow();

  map = new google.maps.Map(
      document.getElementById('map'), {center: sydney, zoom: 15});

  var request = {
    query: 'Museum of Contemporary Art Australia',
    fields: ['name', 'geometry'],
  };

  var service = new google.maps.places.PlacesService(map);

  service.findPlaceFromQuery(request, function(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }
      map.setCenter(results[0].geometry.location);
    }
  });
}
</script>
<!-- <button onclick="myStop()">Stop the time</button>
    <script>
        const myInterval = setInterval(myTimer, 1000);

function myTimer() {
  const date = new Date();
  document.getElementById("demo").innerHTML = date.toLocaleTimeString();
}

function myStop() {
  clearInterval(myInterval);
}
    </script> -->