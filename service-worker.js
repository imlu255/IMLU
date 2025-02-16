const CACHE_NAME = 'imamia-mission-cache-v1';
const urlsToCache = [
  '/',
  '/index.html',
  '/About.html',
  '/About.css',
  '/admin.php',
  '/EC.html',
  '/Donate.html',
  '/PT.html',
  '/BE.css',
  '/BE.html',
  '/Programmes.html',
  '/images/logo.png',
  '/auth.php',
  '/CDelete.php',
  '/Contact.php',
  '/Delete_ECM.php',
  '/Donate.css',
  '/Donate.html',
  '/EC.css',
  '/EC.html',
  '/export_to_excel.php',
  '/index.css',
  '/index.html',
  '/Jaloos.php',
  '/JCreate.php',
  '/JDelete.php',
  '/JEdit.php',
  '/Login.php',
  '/Logout.php',
  '/Membership.php',
  '/Profile.php',
  '/Programmes.css',
  '/Programmes.html',
  '/PT.css',
  '/PT.html',
  '/PT.php',
  '/script.js',
  '/View_Contact.php',
  '/View_ECM.php',
  '/View_Jaloos.php',
  '/Volunteer-for-the-jaloos.css',
  '/Volunteer-for-the-jaloos.html'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        return response || fetch(event.request);
      })
  );
});

importScripts('https://www.gstatic.com/firebasejs/11.3.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/11.3.1/firebase-messaging.js');

firebase.initializeApp({
  apiKey: "AIzaSyAY-wqgEluXDTRd8-xTmqizxEyozpss3G0",
  authDomain: "imamia-mission-london-uk-ec4a7.firebaseapp.com",
  projectId: "imamia-mission-london-uk-ec4a7",
  storageBucket: "imamia-mission-london-uk-ec4a7.firebasestorage.app",
  messagingSenderId: "10244547939",
  appId: "1:10244547939:web:990e313b74e0d9a6aa9f56",
  measurementId: "G-3SJX802TPL"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.icon
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
