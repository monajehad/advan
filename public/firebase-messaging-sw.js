//Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/9.17.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
var firebaseConfig = {
      apiKey: "AIzaSyBzyaQWLrswum6UGZ8PhiSgEFUdmlVZhkI",
      authDomain: "advanced-tender.firebaseapp.com",
      projectId: "advanced-tender",
      storageBucket: "advanced-tender.appspot.com",
      messagingSenderId: "474570405331",
      appId: "1:474570405331:web:2a05d02a8e1746bfca2b26",
      measurementId: "G-ZXYZG4NYZ7"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const {title, body} = payload.notification;
    const notificationOptions = {
        body,
    };

    return self.registration.showNotification(title,
        notificationOptions);
});
