var markers = [];

function display_map (mymap)
{
   
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapid',
        accessToken: 'your.mapbox.access.token'
    }).addTo(mymap);

}

function display_marker(mymap, latitude, longitude, name, localisation){

    /*L.marker([latitude, longitude]).addTo(mymap);*/
    console.log(localisation)
    // L.marker([latitude, longitude])
    let 
    marker = new L.Marker([latitude, longitude])
    marker.addTo(mymap)
    .bindPopup('<strong>' + name +'</strong>' +'<br/>' +localisation)
    .openPopup();
    markers.push(marker)// enregistre marker ds le tableau markers
    console.log(markers);
}



function get_markers(event = null){
    eventtype = event === null ? 'allEvent' : event.target.id
    //eventtype = event  ?si elle est fausse'allEvent' :sinon event.target.id
    fetch(`http://51.75.31.40/project_event/web/app_dev.php/events/json?option=${eventtype}`)
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    console.log(JSON.stringify(myJson));
    //display_marker(mymap, latitude, longitude)
        for (m of markers) {
            mymap.removeLayer(marker)
        }
        for (let events of myJson )
        {
            display_marker(mymap, events.latitude,events.longitude, events.nom, events.localisation)
            
        }
        console.log(markers);
    });
    
}


