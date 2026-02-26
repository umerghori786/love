// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyCbMb72OJbNy1hAd2Nh_fprguJQt2iM1V4",
    authDomain: "notification-e0fd9.firebaseapp.com",
    projectId: "notification-e0fd9",
    storageBucket: "notification-e0fd9.firebasestorage.app",
    messagingSenderId: "521124468544",
    appId: "1:521124468544:web:be0f097bfc1e0e6b674ca5",
    measurementId: "G-XDV9P9PLGN"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});