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
    L.marker([latitude, longitude]).addTo(mymap)
    .bindPopup('<strong>' + name +'</strong>' +'<br/>' +localisation)
    .openPopup();
}

function get_markers(eventType){
    fetch(`http://51.75.31.40/project_event/web/app_dev.php/events/json?option=${eventType}`)
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    console.log(JSON.stringify(myJson));
    //display_marker(mymap, latitude, longitude)
        for (let events of myJson )
        {
            display_marker(mymap, events.latitude,events.longitude, events.nom, events.localisation
            )
           
        }
    });
}

// let state;

// function onPastEvent(){

// }


    // document.getElementById("e_past").addEventListener("click", function get_option();
    // document.getElementById("e_all").addEventListener("click", function get_option();
    let past = document.getElementById('e_past')
    past.addEventListener('click', get_option)

    let futur = document.getElementById('e_futur')
    futur.addEventListener('click', get_option)

    let all = document.getElementById('e_all')
    futur.addEventListener('click', get_option) 

function get_option(){
    past.toggle('e_past')
    futur.toggle('e_futur')
    all.toggle('e_futur')
}


