function display_map (mymap)
{
   
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapid',
        accessToken: 'your.mapbox.access.token'
    }).addTo(mymap);

}

function display_marker(mymap, latitude, longitude){

    L.marker([latitude, longitude]).addTo(mymap);
}




