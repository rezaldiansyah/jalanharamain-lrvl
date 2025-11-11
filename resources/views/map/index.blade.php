<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Peta POI – JalanHaramain</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="/manifest.json" />
    <meta name="theme-color" content="#0b5ed7">

    <!-- Leaflet CSS & JS (CDN) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-o9U0wqEDNy8vMlGdW+QbYh98okV8fG1vAwGZ8aF1C/k=" crossorigin="anonymous">
    <style>
        body { margin: 0; font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Helvetica Neue", "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; }
        #topbar { padding: 10px; background: #0b5ed7; color: white; display: flex; gap: 8px; align-items: center; }
        #map { width: 100vw; height: calc(100vh - 50px); }
        .badge { padding: 4px 8px; border-radius: 4px; background: #eff2f6; color: #333; font-size: 12px; }
        .status { margin-left: auto; font-size: 12px; }
        .offline { color: #ffc107; }
    </style>
</head>
<body>
<div id="topbar">
    <strong>Peta POI</strong>
    <select id="city">
        <option value="">Semua Kota</option>
        <option value="makkah">Makkah</option>
        <option value="madinah">Madinah</option>
    </select>
    <span class="badge">PWA aktif</span>
    <span id="netStatus" class="status">Status jaringan: online</span>
</div>
<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-o9s3bqfVtJYqCtzYqG5i1QbWZ9nE+WkQcfPz6Wj9C2I="
        crossorigin="anonymous"></script>

<!-- Register SW with Vite (module) -->
@vite(['resources/js/sw-register.js'])

<script>
    const netStatusEl = document.getElementById('netStatus');

    function updateNetStatus() {
        const online = navigator.onLine;
        netStatusEl.textContent = 'Status jaringan: ' + (online ? 'online' : 'offline');
        netStatusEl.classList.toggle('offline', !online);
    }
    window.addEventListener('online', updateNetStatus);
    window.addEventListener('offline', updateNetStatus);
    updateNetStatus();

    // Init Leaflet
    const map = L.map('map', { worldCopyJump: true });
    // Default center: Makkah
    map.setView([21.422487, 39.826206], 14);

    const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    const tileLayer = L.tileLayer(tileUrl, {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    });

    tileLayer.on('tileerror', function() {
        // If tiles fail (offline), keep the last cached tiles via SW, or show a hint
        // SW will serve any cached tiles; this hook shows feedback
        console.warn('Tile load error: possibly offline or tile server blocked.');
    });

    tileLayer.addTo(map);

    const markers = [];
    function clearMarkers() {
        markers.forEach(m => map.removeLayer(m));
        markers.length = 0;
    }

    async function loadPOIs(city = '') {
        try {
            const url = city ? `/api/pois?city=${encodeURIComponent(city)}` : '/api/pois';
            const res = await fetch(url);
            const json = await res.json();
            clearMarkers();

            json.data.forEach(poi => {
                const marker = L.marker([poi.lat, poi.lng]).addTo(map);
                marker.bindPopup(
                    `<strong>${poi.name}</strong><br/>
                     <em>${poi.category || '-'}</em> — ${poi.city || '-'}<br/>
                     ${poi.address || ''}<br/>
                     <small>${poi.description || ''}</small>`
                );
                markers.push(marker);
            });

            // Fit to markers when filter applied
            if (markers.length > 0) {
                const group = L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.2));
            }
        } catch (e) {
            console.error('Gagal memuat POI:', e);
            // Offline fallback: keep whatever is cached; SW caches API responses too
            alert('Tidak dapat memuat data POI. Periksa koneksi atau coba lagi.');
        }
    }

    document.getElementById('city').addEventListener('change', (e) => {
        loadPOIs(e.target.value);
    });

    loadPOIs();
</script>
</body>
</html>