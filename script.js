// Get all modals
const modals = document.querySelectorAll('.modal');

// When the user clicks anywhere outside of any modal, close it
window.onclick = function(event) {
  modals.forEach(modal => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });
};

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/service-worker.js').then(registration => {
      console.log('Service Worker registered with scope:', registration.scope);
    }, err => {
      console.log('Service Worker registration failed:', err);
    });
  });
}

// Firebase initialization
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

function requestNotificationPermission() {
  Notification.requestPermission()
    .then(permission => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');
        return messaging.getToken();
      } else {
        console.log('Unable to get permission to notify.');
      }
    })
    .then(token => {
      console.log('FCM Token:', token);
      // Send the token to your server and save it to send notifications later
    })
    .catch(error => {
      console.error('Error getting token:', error);
    });
}

requestNotificationPermission();

// Listen for messages when the app is in the foreground
messaging.onMessage((payload) => {
  console.log('Message received. ', payload);
  // Show notification or handle the message
});
