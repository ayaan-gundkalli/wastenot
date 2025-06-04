document.addEventListener('DOMContentLoaded', function () {
  // 1. Initialize the map
  var map = L.map('map').setView([15.2993, 74.1240], 13); // Default to Goa

  // 2. Load tiles
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
  }).addTo(map);

  // 3. Add marker when user clicks
  let marker;
  map.on('click', function (e) {
    const { lat, lng } = e.latlng;

    // Remove previous marker
    if (marker) {
      map.removeLayer(marker);
    }

    // Add marker
    marker = L.marker([lat, lng]).addTo(map).bindPopup('Your Location').openPopup();

    // Set to hidden inputs
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
  });

  // 4. Optional: Set bounds to Goa region only
//   var bounds = L.latLngBounds([15.2, 74.1], [15.5, 74.3]);
//   map.setMaxBounds(bounds);
//   map.on('drag', function () {
//     map.panInsideBounds(bounds, { animate: false });
//   });
});
