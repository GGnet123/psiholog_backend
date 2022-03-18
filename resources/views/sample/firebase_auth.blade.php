@extends('layout')

@section('title', 'Привет')

@section('content')
    <!-- Post grid -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">

                    <h5 class="text-semibold mb-5">
                        <a href="#" class="text-default">Domestic confined any but son</a>
                    </h5>

                    <ul class="list-inline list-inline-separate text-muted content-group">
                        <li>By <a href="#" class="text-muted">Eugene</a></li>
                        <li>July 20th, 2016</li>
                    </ul>

                    How proceed offered her offence shy forming. Returned peculiar pleasant but appetite differed she. Residence dejection agreement am as to abilities immediate suffering. Ye am depending propriety sweetness distrusts belonging collected. Smiling mention he
                </div>

                <div class="panel-footer panel-footer-condensed">
                    <div class="heading-elements not-collapsible">
                        <ul class="list-inline list-inline-separate heading-text text-muted">
                            <li><a href="#" class="text-muted"><i class="icon-heart6 text-size-base text-pink position-left"></i> 29</a></li>
                        </ul>

                        <a href="#" class="heading-text pull-right">Read more <i class="icon-arrow-right14 position-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js_block')

    <script src="https://www.gstatic.com/firebasejs/5.0.1/firebase.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyD5IfbE632fnZ4v0iSzRMPjbRpsR9dNZ4k",
            authDomain: "talktome-25378.firebaseapp.com",
            projectId: "talktome-25378",
            storageBucket: "talktome-25378.appspot.com",
            messagingSenderId: "808854081113",
            appId: "1:808854081113:web:65a165efb18801baa82b48",
            measurementId: "G-W786NYFX3K"
        };

        firebase.initializeApp(firebaseConfig);

        var provider = new firebase.auth.GoogleAuthProvider();

        firebase.auth().signInWithPopup(provider).then(function(result) {
            // This gives you a Google Access Token. You can use it to access the Google API.
            var token = result.credential.accessToken;
            // The signed-in user info.
            var user = result.user;
            console.log(token, result, result.credential, result.credential.idToken);
            // ...
        }).catch(function(error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            // The email of the user's account used.
            var email = error.email;
            // The firebase.auth.AuthCredential type that was used.
            var credential = error.credential;
            // ...
        });

        firebase.auth().getRedirectResult().then(function(result) {
            if (result.credential) {
                // This gives you a Google Access Token. You can use it to access the Google API.
                var token = result.credential.accessToken;
                console.log(token);
            }
            // The signed-in user info.
            var user = result.user;
        }).catch(function(error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            // The email of the user's account used.
            var email = error.email;
            // The firebase.auth.AuthCredential type that was used.
            var credential = error.credential;
            // ...
        });




    </script>


@endsection

