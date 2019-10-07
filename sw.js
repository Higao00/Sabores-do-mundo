var CACHE_NAME = 'static-v1';

self.addEventListener('install', function (event) {
  event.waitUntil(
    caches.open(CACHE_NAME).then(function (cache) {
      return cache.addAll([
        './offline2.html',
        './manifest.json',
      ]);
    })
  )
});

self.addEventListener('activate', function activator(event) {
  event.waitUntil(
    caches.keys().then(function (keys) {
      return Promise.all(keys
        .filter(function (key) {
          return key.indexOf(CACHE_NAME) !== 0;
        })
        .map(function (key) {
          return caches.delete(key);
        })
      );
    })
  );
});

self.addEventListener('fetch', function (event) {
  event.respondWith(
    caches.match(event.request).then(function (cachedResponse) {
      return cachedResponse || fetch(event.request);
    })
  );
});

self.addEventListener('push', function(event) {
  console.log('[Service Worker] Push Received.');
  console.log(`[Service Worker] Push had this data: `);
  console.log(JSON.parse(event.data.text()));//modified from tutorial to make it more dynamic
  const notificationObject = JSON.parse(event.data.text());//modified from tutorial to make it more dynamic

  const title = notificationObject.title;//modified from tutorial to make it more dynamic
  const options = {
    body: notificationObject.msg,
    icon: notificationObject.icon,
    badge: notificationObject.badge
  };
  self.notificationURL = notificationObject.url;//modified from tutorial to make it more dynamic
  event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', function(event) {
  console.log('[Service Worker] Notification click Received.');
  //console.log(self.notificationURL);
  event.notification.close();

  event.waitUntil(
    clients.openWindow(self.notificationURL)//modified from tutorial to make it more dynamic
  );
});