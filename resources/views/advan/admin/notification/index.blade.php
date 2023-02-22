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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center>
            @if(Session::has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('send.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">المندوب</label>
                            <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
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

    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/api/notification/save-token',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });

            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }


     messaging.onMessage((payload)=> {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });

</script>

@endsection
