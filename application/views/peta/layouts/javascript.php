
    <script src="<?=site_url('api/data/destinasi')?>"></script>
    <script src="<?=site_url('api/data/pointDestinasi')?>"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.1/mapbox-gl-directions.css" type="text/css">
    <script type="text/javascript">
      mapboxgl.accessToken = 'pk.eyJ1IjoiZGFuYW5nd2lqYXlhIiwiYSI6ImNsbW1xZWV2dzBxdWoya3Rjc2tvZTM3NGoifQ._G-vrFPuxuEbNIZxlbXjjg';

      const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [106.4512, -6.4568],
        zoom: 11
      });

      map.addControl(
        new mapboxgl.GeolocateControl({
          positionOptions: {
            enableHighAccuracy: true
          },
          trackUserLocation: true,
          showUserHeading: true
        })
      );

      let startCoordinates;
      let destinationCoordinates = null;  // Inisialisasi dengan null

      // Fungsi untuk mengupdate destinationCoordinates berdasarkan pilihan pengguna
      function updateDestinationCoordinates() {
        const selectedValue = $("#lokasiakhir").val();
        if (selectedValue) {
          const [lng, lat] = selectedValue.split('|').map(parseFloat);
          destinationCoordinates = [lng, lat];
        } else {
          destinationCoordinates = null;  // Atur kembali menjadi null jika tidak ada yang dipilih
        }
      }

      // Panggil fungsi getdata untuk mendapatkan data destinasi
      getdata();

      // Event handler saat pengguna memilih lokasi akhir
      $("#lokasiakhir").change(function() {
        updateDestinationCoordinates();
      });

      // Fungsi untuk mendapatkan data destinasi
      function getdata() {
        var result = "";
        for (var i = 0; i < dataDestinasi.length; i++) {
          var nama = dataDestinasi[i][0].name;
          var lat = dataDestinasi[i][0].lat;
          var lng = dataDestinasi[i][0].lng;
          var coord = lng + "|" + lat;
          result += "<option value='" + coord + "'>" + nama + "</option>";
        }


        $("#lokasiakhir").html(result);

        // Pilih destinasi pertama secara otomatis (atau sesuaikan dengan kebutuhan Anda)
        if (dataDestinasi.length > 0) {
          const firstDestination = dataDestinasi[0][0];
          const coord = firstDestination.lng + "|" + firstDestination.lat;
          $("#lokasiakhir").val(coord);
          updateDestinationCoordinates();  // Update destinationCoordinates saat memuat halaman
        }
      }

      let marker; // Variabel untuk menyimpan marker

      //Rumus Haversine
      function calculateHaversine(startCoords, endCoords) {
        const R = 6371; // Radius of the Earth in km
        const dLat = deg2rad(endCoords[1] - startCoords[1]);
        const dLon = deg2rad(endCoords[0] - startCoords[0]);
        const a =
          Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(deg2rad(startCoords[1])) * Math.cos(deg2rad(endCoords[1])) *
          Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const distance = R * c; // Distance in km
        return distance;
      }
      function deg2rad(deg) {
        return deg * (Math.PI / 180);
      }
      // Event handler saat pengguna mengklik peta
      map.on('click', (e) => {
        startCoordinates = [e.lngLat.lng, e.lngLat.lat];  // Perbarui koordinat titik awal

        // Hapus marker sebelumnya jika ada
        if (marker) {
          marker.remove();
        }

        // Tambahkan marker di lokasi yang diklik
        marker = new mapboxgl.Marker()
          .setLngLat(startCoordinates)
          .addTo(map);

        // Hitung jarak dan tampilkan di elemen HTML
        const distance = calculateHaversine(startCoordinates, destinationCoordinates);
        const distanceInfoElement = document.getElementById('distance-info');
        distanceInfoElement.innerText = distance.toFixed(2) + ' km';
        console.log('Distance:', distance, 'km');
      });
            // Event handler saat tombol di-klik
            document.getElementById('calculateRouteButton').addEventListener('click', function() {
        // Periksa apakah koordinat awal dan tujuan tersedia
        if (!startCoordinates) {
          console.log('Pilih koordinat awal terlebih dahulu.');
          return;
        }

        if (!destinationCoordinates) {
          console.log('Pilih koordinat tujuan terlebih dahulu.');
          return;
        }

        const apiRoute = "https://www.google.com/maps/dir/?api=1&origin=" +
        startCoordinates[1] + "," + startCoordinates[0] +
        "&destination=" + destinationCoordinates[1] + "," + destinationCoordinates[0];

        console.log('Google Maps Route:', apiRoute);
        // Buka URL di tab atau jendela baru
        window.open(apiRoute, '_blank');
      });
      // Event handler untuk rute
      document.getElementById('RouteButton').addEventListener('click', function() {
        // Periksa apakah koordinat awal dan tujuan tersedia
        if (!startCoordinates) {
          console.log('Pilih koordinat awal terlebih dahulu.');
          return;
        }

        if (!destinationCoordinates) {
          console.log('Pilih koordinat tujuan terlebih dahulu.');
          return;
        }

        const mapboxRoute = "https://api.mapbox.com/directions/v5/mapbox/driving/" + startCoordinates[0] + "," + startCoordinates[1] + ";" + destinationCoordinates[0] + "," + destinationCoordinates[1] + "?steps=true&geometries=geojson&access_token=" + mapboxgl.accessToken;

        console.log(mapboxRoute);

        $.ajax({
          method: 'GET',
          url: mapboxRoute,
        })
        .done(function(data) {
          console.log('API Response:', data);  // Log the API response for inspection
          if (data && data.routes && data.routes.length > 0) {
            const rute = data.routes[0].geometry;
            // Hapus rute sebelumnya jika ada
            if (map.getLayer('route')) {
              map.removeLayer('route');
              map.removeSource('route');
            }
            map.addLayer({
              id: 'route',
              type: 'line',
              source: {
                type: 'geojson',
                data: {
                  type: 'Feature',
                  geometry: rute
                }
              },
              paint: {
                'line-width': 5,
                'line-color': 'blue'
              }
            });
          } else {
            console.error('No route data found.');
          }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
          console.error('Error fetching route data:', errorThrown);
        });
      });

      // Fungsi untuk membuat elemen ikon berdasarkan gambar .png
      function createMarkerElement(gambarUrl) {
        const markerElement = document.createElement('div');
        markerElement.className = 'marker';
        markerElement.innerHTML = `<img src="${gambarUrl}" alt="Marker" />`; // Menggunakan gambar .png
        return markerElement;
      }

      fetch('<?=base_url('api/data/pointDestinasi')?>')
        .then(response => response.json())
        .then(data => {
          const addedMarkers = {};

          data.forEach(point => {
            const coordinates = point.geometry.coordinates;
            const name = point.properties.name;
            const lokasi = point.properties.lokasi;
            const keterangan = point.properties.keterangan;
            const gambarName = point.properties.gambar;  // Nama gambar dari properti "gambar"

            let icon;
            if (keterangan === 'Hotel') {
              // Ganti dengan path ke gambar .png untuk hotel
              icon = '<?=base_url('assets/images/Hotel_Marker.png')?>';
            } else if (keterangan === 'Wisata') {
              // Ganti dengan path ke gambar .png untuk wisata
              icon = '<?=base_url('assets/images/Wisata_Marker.png')?>';
            }

            if (addedMarkers[name]) {
              addedMarkers[name].remove();
            }

            // Buat URL gambar dengan menggunakan base_url dan nama gambar
            const gambarUrl = '<?=base_url('assets/unggah/')?>' + gambarName;
            console.log(gambarUrl);

            const marker = new mapboxgl.Marker({
              element: createMarkerElement(icon)
            })
              .setLngLat(coordinates)
              .setPopup(new mapboxgl.Popup().setHTML(`<h5>${name}</h5><p>${lokasi}</p><img src="${gambarUrl}" alt="${name}" width="100">`))
              .addTo(map);

            addedMarkers[name] = marker;
          });
        })
        .catch(error => console.error('Error fetching data:', error));
  </script>

