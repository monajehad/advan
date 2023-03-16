@extends('layouts.cpanel.app')

@section('title')
الرسائل
@endsection
@section('style')
<style>
#show-password,
#show-new-password,
#show-confirm-new-password {
    cursor: pointer;
}

.checkbox-cutom-label {
    font-size: 15px !important;
    font-weight: bold !important;
}
</style>
@endsection


@section('content')

<!--begin::Container-->
<div class="container">
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-1 py-4 mx-5 mb-4">
            <h2 class="card-title align-items-start flex-column">

                 الرسائل

            </h2>

        </div>
        <!--end::Header-->
            <div class="d-flex flex-row px-4">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px offcanvas-mobile-on" id="kt_chat_aside">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin:Search-->
                            <div class="input-group input-group-solid" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="left:0">
                                        <span class="svg-icon svg-icon-lg">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </div>
                                <form class="form">
                                    <input type="text" class="form-control py-4 h-auto" id="search_input" name="search_input" placeholder="اسم المندوب">

                                </form>
                            </div>
                            <!--end:Search-->
                            <!--begin:Users-->
                            <div class="mt-7 users scroll scroll-pull ps ps--active-y" style="height: auto; overflow: hidden;">
                            @foreach ( $users as $user)
                                <!--begin:User-->
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50 mr-3">
                                            <img alt="Pic" src="assets/media/users/300_12.jpg">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">{{$user->name}}</a>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span class="text-muted font-weight-bold font-size-sm">35 mins</span>
                                    </div>
                                </div>
                                <!--end:User-->
                                @endforeach

                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 55px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 40px;"></div></div></div>
                            <!--end:Users-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div><div class="offcanvas-mobile-overlay"></div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid mr-lg-8" id="kt_chat_content">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header align-items-center px-4 py-3">

                            <div class="text-right pr-6 flex-grow-1">
                                <div class="text-dark-75 font-weight-bold font-size-h5">Matt Pears</div>


                            </div>
<hr>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            @if(count($chats)==0)
                            <p>لاتوجد رسائل حتى اللحظة, سيتم عرض الرسائل المستقبلة والمرسلة هنا, قم بالتواصل مع الأشخاص الآخرين في الشركة</p>
                           @endif

                            <!--begin::Scroll-->
                            <div class="scroll scroll-pull ps ps--active-y" data-mobile-height="350" style="height: 206px; overflow: hidden;">
                                <!--begin::Messages-->
                                <div class="messages">
                                    @foreach($chats as $chat )
                                    @if($chat->sender_id === auth()->user()->id)

                                    <!--begin::Message In-->
                                    <div class="d-flex flex-column mb-5 align-items-start">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-40 mr-3">
                                                <img alt="Pic" src="assets/media/users/300_12.jpg">
                                            </div>

                                            <div>
                                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6"> {{$chat->sender_name}} </a>
                                                <span class="text-muted font-size-sm">2 Hours</span>
                                            </div>
                                        </div>
                                        <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">{{$chat->message}}</div>
                                    </div>
                                    <!--end::Message In-->
                                    <!--begin::Message Out-->
                                    @else
                                    <div class="d-flex flex-column mb-5 ">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="text-muted font-size-sm">3 minutes</span>

                                                <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$chat->sender_name}}</a>
                                            </div>
                                            <div class="symbol symbol-circle symbol-40 ml-3">
                                                <img alt="Pic" src="assets/media/users/300_21.jpg">
                                            </div>
                                        </div>
                                        <div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">{{$chat->message}} </div>
                                    </div>
                                    @endif
                                    <!--end::Message Out-->

                                @endforeach
                                </div>
                                <!--end::Messages-->
                            <div class="ps__rail-x" style="left: 0px; bottom: -100px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 100px; height: 206px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 19px; height: 40px;"></div></div></div>
                            <!--end::Scroll-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer align-items-center">

                     <form action="" method="POST">
                                        @csrf
                                         <!--begin::Compose-->
                            <textarea class="form-control border-0 p-2" rows="2" name="message" placeholder="الرسالة"></textarea>
                            <div class="d-flex align-items-center justify-content-between mt-5">
                                <div class="mr-3">
                                    <a href="#" class="btn btn-clean btn-icon btn-md mr-1">
                                        <i class="flaticon2-photograph icon-lg"></i>
                                    </a>
                                    <a href="#" class="btn btn-clean btn-icon btn-md">
                                        <i class="flaticon2-photo-camera icon-lg"></i>
                                    </a>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">إرسال</button>
                                </div>
                            </div>
                            <!--begin::Compose-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>

        <!--begin::Body-->

        <div class="card-body py-0">
            <!--begin::Table-->
            <div class="category-table-body">

            </div>

            <!--End::Table-->
        </div>
        <!--end::Body-->
    </div>




</div>
<div class="user-permission-body">

    <!--end::Container-->
    @endsection
{{--
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
</div> --}}
{{-- <div class="message-input-container">
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label>الرسالة</label>
            <input type="text" name="message" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">إرسال</button>
        </div>
    </form>
</div>
@endsection --}}

@section('script')
<script>
    function load_data_table(page='') {
        $.ajax({
            url: '{{url("message/")}}' ,
            data:{search:$('#search_input').val()},
            type: "get",
            success: function( response ) {
                $('.users').html(response.userName)

            },
            error:function(response){
             }

        })
    }

    $('#search_input').keyup(function(){
            load_data_table()
        })
</script>
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

        axios.post('/message', {
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
