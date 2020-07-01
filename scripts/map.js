class Map 
{
  constructor() 
  {
    this.map = L.map('map').setView([47.19, 2.87], 6);
    this.greenIcon = L.icon({
      iconUrl: 'images/marker.png',
      iconSize:     [25, 41], 
      iconAnchor: [13,41],
      className : 'green_marker',
    });
    this.redIcon = L.icon({
      iconUrl: 'images/marker.png',
      iconSize:     [25, 41], 
      iconAnchor: [13,41],
      className : 'red_marker',
    });
    this.chosenIcon = this.greenIcon;
    this.url = "https://projetsls.fr/SPA-Chamalieres/index.php?action=spajson";
    this.initialisation();
    this.RequestAllSpa();
  }

  initialisation() // Map's initalisation with Leaflet
  {
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    maxZoom: 20,
    minZoom:6,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1Ijoic3RhcmJvc3NtYW4iLCJhIjoiY2s0aDZpcTV0MTB5YzNxbjZ0NnhscDl6MiJ9.WVui8a0N0vXf0tlSH2TY1g'
    }).addTo(this.map);
  }

  RequestAllSpa()
  {
    let oXhr = new XMLHttpRequest(); // objects to interact with servers, without having to do a full page refresh.
    oXhr.onload = this.ajaxOnLoad.bind(this);
    
    oXhr.onerror = function (data) 
    {
      console.log('Erreur ...');
    }
    oXhr.open('GET', this.url);
    oXhr.send();
  }

  ajaxOnLoad(e)
  {
    let data = JSON.parse(e.target.responseText); // method parses a JSON string who returns the text received from a server following a request being sent.

    for (var i = 0; i < data.length; i++) 
    {
      if (data[i].name == "SPA_Chamalieres"){
        this.chosenIcon = this.greenIcon;   
      }
      else {
        this.chosenIcon = this.redIcon;
      }
      let marker = L.marker([data[i].Lat_coord,data[i].Long_coord], {icon :this.chosenIcon});
      marker.addTo(this.map);
      marker.bindPopup("<center><b>" + data[i].name+"</b></center>" + data[i].adress +"</br>"+ "Numéro de téléphone : 0" + data[i].telephone); // Add a popup to every markers
    }
  }
}
let mymap = new Map();