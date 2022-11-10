@extends('layouts.app')

@section('content')
    
    <body>
        <section class="section-50 min-vh-65">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-6">
                        <h2 class="m-b-50 heading-line">Activity</h2>
                    </div>
                    <div class="col-6 text-end" id="read-all">
                        @if (count($notifications) != 0)
                            <button class="btn btn-warning" onclick="readAll()">
                                Read All
                            </button>
                        @endif
                    </div>
                </div>

                <div class="notification-ui_dd-content my-auto">
                    @if (count($notifications) == 0)
                        <div class="text-center my-auto">
                            <h5>There are currently no new notifications. Check back later!</h5>
                        </div>
                    @else
                        <!-- NEW NOTIFICATION -->
                        @foreach ($notifications as $notification)
                            <div class="notification-list notification-list--unread">
                                {{-- noti start --}}
                                <div class="notification-list_content">
                                    <div class="notification-list_img my-4 my-md-3">
                                        <img src="{{ $notification->artwork_id ? $notification->artwork_id->asset->asset_url : 'https://stateoftheart.blob.core.windows.net/wad2/logo.png' }}" alt="user">
                                    </div>
                                    <div class="notification-list_detail my-4 my-md-3">
                                        <p>{{ $notification->description }}</p>
                                        <p class="text-muted"><small>{{ $notification->timestamp == 1 ? $notification->timestamp . 'min ago' : $notification->timestamp . 'mins ago' }}</small></p>
                                    </div>
                                </div>


                                {{-- right side of noti --}}
                                <div class="notification-list_feature-img row p-0 g-0">
                                    <div class="row justify-content-center g-0">
                                        Read
                                    </div>
                                    <div class="row justify-content-center g-0">
                                        <label class="switch switch-1-1 " for="switch-{{ $notification->id }}">
                                            <input type="checkbox" name="switch-1-1" id="switch-{{ $notification->id }}" onclick="postRead({{ $notification->id }})">
                                            <span class="slider round slider-1-1"></span>
                                        </label>

                                    </div>
                                    {{-- <img class="my-4 my-md-3" src="{{ $notification->user_pic }}" alt="Feature image"> --}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
            </div>
        </section>

        <script>
            function postRead(value) {
        
                axios.post("/api/notification/read", {
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
                        console.log(error.message);
                    })

            }

            var notifications_ids = {{ Illuminate\Support\Js::from($notifications_ids) }};

            function readAll() {
                for (var id of notifications_ids) {
                    postRead(id);
                    document.getElementById('switch-' + id).checked = true;
                }

                var read_all_div = document.getElementById('read-all');

                read_all_div.classList.add('text-success');
                read_all_div.innerHTML = "All notifications have been read!"
            }
        </script>

    </body>

@endsection