@extends('layouts.cpanel.app')


@section('style')

<style>
    .chat-container {
        display: flex;
        flex-direction: column;
    }

    .chat {
        border: 1px solid gray;
        border-radius: 3px;
        width: 50%;
        padding: 0.5em;
    }

    .chat-left {
        background-color: white;
        align-self: flex-start;
    }

    .chat-right {
        background-color: #3f9ae5;
        align-self: flex-end;
    }

    .message-input-container {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: white;
        border: 1px solid gray;
        padding: 1em;


    }
</style>
@endsection
@section('content')

<div class="container" style="margin-bottom: 480px" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="chat-container">
                        @if(count($chats)==0)
                            <p>There is no chat yet.</p>
                        @endif
                        @foreach($chats as $chat )
                            @if($chat->sender_id === auth()->user()->id)
                                <p class="chat chat-right">
                                    <b>{{$chat->sender_name}} :</b><br>
                                    {{$chat->message}}                                    </p>
                            @else
                                <p class="chat chat-left">
                                    <b>{{$chat->sender_name}} :</b><br>
                                    {{$chat->message}}
                                </p>
                            @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="message-input-container">
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label>Message</label>
            <input type="text" name="message" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">SEND MESSAGE</button>
        </div>
    </form>
</div>
@endsection

@section('script')
{{-- <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-messaging.js"></script> --}}
<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
    // importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js')

    import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-analytics.js";
    import { getMessaging , getToken } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-messaging.js";

    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseApp = initializeApp({
      apiKey: "AIzaSyBzyaQWLrswum6UGZ8PhiSgEFUdmlVZhkI",
      authDomain: "advanced-tender.firebaseapp.com",
      projectId: "advanced-tender",
      storageBucket: "advanced-tender.appspot.com",
      messagingSenderId: "474570405331",
      appId: "1:474570405331:web:2a05d02a8e1746bfca2b26",
      measurementId: "G-ZXYZG4NYZ7"
    });

    // Initialize Firebase
    // const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(firebaseApp);
    const messaging = getMessaging(firebaseApp);

    messaging.usePublicVapidKey("BNi8WFY0HVBE2YvPXCfj7wDGbURGAh6rD57klttmetVL-PDYCnPNOgvUfC_RZquDF6uXjS5f78PXAcnFI9KuNTE");
        function sendTokenToServer(fcm_token) {
            const user_id = '{{auth()->user()->id}}';
        //    console.log('token retrieved',fcm_token);

        axios.post('/api/save-token', {
            fcm_token,user_id
         }).then(res=>{
        console.log(res);

  })



}
function retreiveToken(){
  // Retrieve Firebase Messaging object.
  messaging.getToken().then((currentToken) => {
                if (currentToken) {
    // Send the token to your server and update the UI if necessary
    // ...
    sendTokenToServer(currentToken);
    // updateUIForPushEnabled(currentToken);
     } else {
    // Show permission request UI
    // console.log('No registration token available. Request permission to generate one.');
    // Show permission UI.
                    //updateUIForPushPermissionRequired();
                    //etTokenSentToServer(false);
    alert('You should allow notification!');
     }
    }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
            // showToken('Error retrieving Instance ID token. ', err);
            // setTokenSentToServer(false);
    });


}

       retreiveToken();
        messaging.onTokenRefresh(()=>{
            retreiveToken();


        });

        messaging.onMessage((payload)=>{
            console.log('Message received');
            console.log(payload);

            location.reload();
        });
</script>

@endsection
