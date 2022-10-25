@extends('layouts.app')

@section('content')
    
    <body>
        <section class="section-50">
            <div class="container">
                <h3 class="m-b-50 heading-line">Notifications</h3>

                <div class="notification-ui_dd-content">
                    @if (count($notifications) == 0)
                        <div class="row text-center">
                            <h5>There are currently no new notifications. Check back later!</h5>
                        </div>
                    @else
                        
                    @endif
                    <!-- NEW NOTIFICATION -->
                    @foreach ($notifications as $notification)
                        <div class="notification-list notification-list--unread">
                            <div class="notification-list_content">
                                <div class="notification-list_img my-4 my-md-3">
                                    <img src="{{ $notification->artwork_id ? $notification->artwork_id->asset->asset_url : 'https://stateoftheart.blob.core.windows.net/wad2/logo.png' }}" alt="user">
                                </div>
                                <div class="notification-list_detail my-4 my-md-3">
                                    <p>{{ $notification->description }}</p>
                                    <p class="text-muted"><small>{{ $notification->timestamp }} mins ago</small></p>
                                </div>
                            </div>
                            
                            <div class="notification-list_feature-img">
                                <label class="switch switch-1-1" for="switch-{{ $notification->id }}">
                                    <input type="checkbox" name="switch-1-1" id="switch-{{ $notification->id }}" onclick="postRead({{ $notification->id }})">
                                    <span class="slider round slider-1-1"></span>
                                </label>
                                <img class="my-4 my-md-3" src="{{ $notification->user_pic }}" alt="Feature image">
                            </div>
                        </div>
                    @endforeach
                    
            </div>
        </section>

        <script>
            function postRead(value) {
        
                axios.post("http://localhost:8000/api/notification/read", {
                    notification_id: value
                })
                    .then(response => {
                        var btn = document.getElementById('switch-' + value);
                        var label = btn.parentElement;
                        var label_parent = label.parentElement;
                        var div_parent_label = label_parent.parentElement;

                        btn.disabled = true;
                        div_parent_label.style.borderLeft = "none";
                        div_parent_label.classList.add('text-muted');

                        console.log(response.data.message);
                    })
                    .catch(error => {
                        console.log(response.data.message);
                    })

            }
        </script>

    </body>

@endsection