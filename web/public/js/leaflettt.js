function display_map (mymap)
{
   
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapid',
        accessToken: 'your.mapbox.access.token'
    }).addTo(mymap);

}

function display_marker(mymap, latitude, longitude, name, adresse){

    /*L.marker([latitude, longitude]).addTo(mymap);*/
   
    L.marker([latitude, longitude]).addTo(mymap)

    .bindPopup(name, adresse)
    .openPopup();
}

function get_markers(){
    fetch('http://51.75.31.40/project_event/web/app_dev.php/events/json')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    console.log(JSON.stringify(myJson));
    //display_marker(mymap, latitude, longitude)
        for (let events of myJson )
        {
            console.log(events)
            display_marker(mymap, events.latitude,events.longitude, events.nom, events.adresse)
           
        }  
  });
}





