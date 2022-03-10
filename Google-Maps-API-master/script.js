function iniciarMap(){
    var coord = {lat:37.55293378997322 ,lng: -5.081764044766121};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}