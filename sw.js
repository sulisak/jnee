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

// 3. Fetch Event: Pass network requests through so your live POS system always fetches fresh data
self.addEventListener('fetch', (event) => {
    event.respondWith(
        fetch(event.request).catch(() => {
            // Fallback option if network is offline (optional)
            return caches.match(event.request);
        })
    );
});