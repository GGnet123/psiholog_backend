
var config = {
    messagingSenderId: "808854081113"
  };
  firebase.initializeApp(config);
  const messaging = firebase.messaging();

  navigator.serviceWorker.register('/firebase-messaging-sw.js')
  .then(function (registration) {
      messaging.useServiceWorker(registration);

      // Request for permission
      messaging.requestPermission()
      .then(function() {
        console.log('Notification permission granted.');
        // TODO(developer): Retrieve an Instance ID token for use with FCM.
        messaging.getToken()
        .then(function(currentToken) {
          if (currentToken) {
            console.log('Token: ' + currentToken)
            sendTokenToServer(currentToken);
          } else {
            console.log('No Instance ID token available. Request permission to generate one.');
            setTokenSentToServer(false);
          }
        })
        .catch(function(err) {
          console.log('An error occurred while retrieving token. ', err);
          setTokenSentToServer(false);
        });
      })
      .catch(function(err) {
        console.log('Unable to get permission to notify.', err);
      });
  });

  function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
  }


  // Handle incoming messages
  messaging.onMessage(function(payload) {
    console.log("Notification received: ", payload);
    let today = new Date();
    let date = today.getFullYear()+'-'+pad((today.getMonth()+1), 2)+'-'+pad(today.getDate(), 2);
    let time = pad(today.getHours(), 2) + ":" + pad(today.getMinutes(), 2) + ":" + pad(today.getSeconds(), 2);
    let dateTime = date+' '+time;


    payload = payload.notification;

  });

  // Callback fired if Instance ID token is updated.
  messaging.onTokenRefresh(function() {
    messaging.getToken()
    .then(function(refreshedToken) {
      console.log('Token refreshed.');
      // Indicate that the new Instance ID token has not yet been sent
      // to the app server.
      setTokenSentToServer(false);
      // Send Instance ID token to app server.
      sendTokenToServer(refreshedToken);
    })
    .catch(function(err) {
      console.log('Unable to retrieve refreshed token ', err);
    });
  });

  // Send the Instance ID token your application server, so that it can:
  // - send messages back to this app
  // - subscribe/unsubscribe the token from topics
  function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log('Sending token to server...');




      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
    } else {
      console.log('Token already sent to server so won\'t send it again ' +
          'unless it changes');
    }
  }

  function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') == 1;
  }

  function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
  }
