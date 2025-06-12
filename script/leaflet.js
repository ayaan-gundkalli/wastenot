document.addEventListener('DOMContentLoaded', function () {

  var map = L.map('map').setView([15.496777,73.827827], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
  }).addTo(map);

  let marker;
  map.on('click', function (e) {
    const { lat, lng } = e.latlng;

    if (marker) {
      map.removeLayer(marker);
    }

    marker = L.marker([lat, lng]).addTo(map).bindPopup('Your Location').openPopup();
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
  });
});
