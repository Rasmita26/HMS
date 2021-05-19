self.addEventListener('install', function(event) {
    self.skipWaiting();
    console.log('Installed sw.js', event);
});

self.addEventListener('activate', function(event) {});

self.addEventListener("fetch", function(event) {
    console.log('WORKER: fetch event in progress.');
});