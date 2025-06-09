let map = null;

function openMapModal(listerLat, listerLng) {
  const modal = document.getElementById("mapModal");
  modal.style.display = "flex";

  if (map) {
    map.remove();
  }

  const mapContainer = document.getElementById("leafletMap");
  mapContainer.innerHTML = '';
  mapContainer.innerHTML = '<div id="map-canvas" style="height:100%;width:100%"></div>';

  // Define custom marker icons
  const redIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  const blueIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  setTimeout(() => {
    map = L.map('map-canvas').setView([listerLat, listerLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    })
    .on('tileerror', () => console.log("Tile loading error"))
    .addTo(map);

    navigator.geolocation.getCurrentPosition(
      (position) => {
        const receiverLat = position.coords.latitude;
        const receiverLng = position.coords.longitude;
        map.setView([(receiverLat + listerLat) / 2, (receiverLng + listerLng) / 2], 13);

        L.marker([receiverLat, receiverLng], { icon: blueIcon })
          .addTo(map)
          .bindPopup("Your Location");

        L.marker([listerLat, listerLng], { icon: redIcon })
          .addTo(map)
          .bindPopup("Food Location");

        // Draw route using ORS
        fetch('https://api.openrouteservice.org/v2/directions/driving-car/geojson', {
          method: 'POST',
          headers: {
            'Authorization': '5b3ce3597851110001cf624802476ec5504143b9b548a8ba201dbc41',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            coordinates: [
              [receiverLng, receiverLat],
              [listerLng, listerLat]
            ],
            preference: "shortest",
            instructions: false
          })
        })
        .then(response => response.json())
        .then(data => {
          L.geoJSON(data, {
            style: { color: ' #00008B', weight: 5 }
          }).addTo(map);
        })
        .catch(() => {
          L.polyline(
            [[receiverLat, receiverLng], [listerLat, listerLng]],
            { color: '#00008b', dashArray: '5,5' }
          ).addTo(map);
        });
      },
      () => {
        L.marker([listerLat, listerLng], { icon: redIcon })
          .addTo(map)
          .bindPopup("Food Location");
      }
    );
  }, 50);
}

function closeMapModal() {
  document.getElementById("mapModal").style.display = "none";
  if (map) {
    map.remove();
    map = null;
  }
}
