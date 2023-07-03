// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-analytics.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyAraNXlq13M0V8CM_ESjrnyLcJBPuzMuOw",
    authDomain: "it-each.firebaseapp.com",
    databaseURL: "https://it-each-default-rtdb.firebaseio.com",
    projectId: "it-each",
    storageBucket: "it-each.appspot.com",
    messagingSenderId: "732984128510",
    appId: "1:732984128510:web:027026c7b4f2f8fad186af",
    measurementId: "G-60RQ0P2EEQ"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
    // ...
});