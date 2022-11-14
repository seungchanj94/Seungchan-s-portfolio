
//Lat and long variable
var ladtitute = document.getElementById("lat").innerHTML;
var longtitute = document.getElementById("long").innerHTML;
function initMap(){
    // Map options
    var options = {
      zoom:8,
      center:{lat:ladtitute,lng:longtitute}
    }

    // New map
    var map = new google.maps.Map(document.getElementById('map'), options);


}
