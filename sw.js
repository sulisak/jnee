// sw.js - Service Worker for SVNS Soft POS PWA

const CACHE_NAME = 'svns-pos-cache-v1';

// 1. Install Event: Triggered when the service worker is first installed
self.addEventListener('install', (event) => {
    // Force the waiting service worker to become the active service worker
    self.skipWaiting();
});

// 2. Activate Event: Clean up old caches if you update version numbers later
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        console.log('Clearing old cache:', cache);
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
    // Take control of all pages immediately
    return clients.claim();
});

// 3. Fetch Event: Safely handle requests without crashing on POST or cache misses
self.addEventListener('fetch', (event) => {
    // Skip non-GET requests (like POST AJAX uploads)
    if (event.request.method !== 'GET') {
        return;
    }

    // Skip navigation requests (standard page loads like /brand) so Apache handles them directly
    if (event.request.mode === 'navigate') {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .catch(() => {
                return caches.match(event.request).then((cachedResponse) => {
                    return cachedResponse || new Response('Network error', {
                        status: 408,
                        headers: { 'Content-Type': 'text/plain' }
                    });
                });
            })
    );
});