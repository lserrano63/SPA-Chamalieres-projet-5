class Map 
{
  constructor() 
  {
    this.map = L.map('map').setView([47.19, 2.87], 7);
    this.markers = L.markerClusterGroup();
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
    this.url = ;
    this.initialisation();
  }

  initialisation() // Map's initalisation with Leaflet
  {
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    maxZoom: 20,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1Ijoic3RhcmJvc3NtYW4iLCJhIjoiY2s0aDZpcTV0MTB5YzNxbjZ0NnhscDl6MiJ9.WVui8a0N0vXf0tlSH2TY1g'
    }).addTo(this.map);
  }