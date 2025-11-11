/* Simple PWA Service Worker for JalanHaramain Map + POI */

const CACHE_NAME = 'jh-pwa-v1';
const APP_SHELL = [
  '/', '/map', '/manifest.json',
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((c) => c.addAll(APP_SHELL)).then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(keys.map((k) => (k === CACHE_NAME ? null : caches.delete(k))))
    ).then(() => self.clients.claim())
  );
});

function isHtml(request) {
  return request.destination === 'document' || request.headers.get('accept')?.includes('text/html');
}

function isStaticAsset(request) {
  return ['style', 'script', 'font'].includes(request.destination);
}

function isImage(request) {
  return request.destination === 'image';
}

function isTile(url) {
  return url.hostname.endsWith('tile.openstreetmap.org');
}

self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);

  // API POIs: network-first, fallback to cache
  if (url.pathname.startsWith('/api/pois')) {
    event.respondWith(
      fetch(event.request)
        .then((res) => {
          const clone = res.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
          return res;
        })
        .catch(() => caches.match(event.request))
    );
    return;
  }

  // HTML: network-first
  if (isHtml(event.request)) {
    event.respondWith(
      fetch(event.request)
        .then((res) => {
          const clone = res.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
          return res;
        })
        .catch(() => caches.match(event.request))
    );
    return;
  }

  // Static assets: stale-while-revalidate
  if (isStaticAsset(event.request)) {
    event.respondWith(
      caches.match(event.request).then((cached) => {
        const networkFetch = fetch(event.request).then((res) => {
          const clone = res.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
          return res;
        });
        return cached || networkFetch;
      })
    );
    return;
  }

  // Images and map tiles: cache-first
  if (isImage(event.request) || isTile(url)) {
    event.respondWith(
      caches.match(event.request).then((cached) => {
        return (
          cached ||
          fetch(event.request)
            .then((res) => {
              const clone = res.clone();
              caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
              return res;
            })
            .catch(() => cached)
        );
      })
    );
    return;
  }

  // Default: try network, fallback cache
  event.respondWith(
    fetch(event.request)
      .then((res) => {
        const clone = res.clone();
        caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
        return res;
      })
      .catch(() => caches.match(event.request))
  );
});