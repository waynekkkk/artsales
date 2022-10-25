@extends('layouts.app')

@section('content')
    <body>
        
        <div id="artist-profile">
            <!-- Dynamic displaying of background img. See mini lab 2 and how they do it -->

            <!-- To make it dynamic and customisable to user -->
            <img id="banner-image" src="{{ $user->banner ? $user->banner->asset_url : 'https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1160&q=80' }}" alt="Banner Image">
            
        </div>

        <div class="container">
            <div class="display-pic text-center">
                <!-- Dynamic displaying of dp. Similar to profileBackground --> 
                <!-- Nav bar too.  -->
                <img id="profile-image" src="{{ $user->profile_picture ? $user->profile_picture->asset_url : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU' }}" alt="Profile Image">
                <div class="profile-image-animation"></div>
            </div>

            @error('artwork_error')
                <div class="row justify-content-center text-center col-lg-6 offset-lg-3">
                    <div class="alert alert-danger text-center">                      
                        {{ $message }}
                    </div> 
                </div>
            @enderror
    
            <div class="artist-name text-center">
                <p class="my-3 mx-auto text-center fs-2 fw-bold">{{ $user->name }}</p>

                @if (Auth::check())
                    @if (Auth::user()->id == $user->id)
                        <button type="button" class="btn btn-dark btn-block rounded-pill mb-5" onclick="window.location.href='{{ route('user.edit_particulars', Auth::user()->id) }}';">Edit Details</button>    
                    @endif
                @endif
                
            </div>
    
            <div class="artist-stats mx-auto justify-content-center d-flex">
                <span id="artist-artworks" class="text-center">
                    {{ count($artworks) }}<br>
                    <span class="fs-6 fw-normal">Artworks</span>
                </span>
                <span id="artist-ranking" class="text-center">
                    {{ $user_ranking }}
                    <br><span class="fs-6 fw-normal">Rank</span>
                </span>
                <span id="artist-events" class="text-center">
                    {{ count($museum_artists_involvement) }}<br>
                    <span class="fs-6 fw-normal">Events</span>
                </span>
            </div>
    
            <div id="artist-socials">
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-brands fa-twitter"></i></button>
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-brands fa-instagram"></i></button>
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-solid fa-envelope"></i></button>
            </div>
    
            <div class="page-feature">
                <ul class="nav nav-pills  nav-black nav-fill">
                    <li class="nav-item mx-2 mb-2 mb-md-4"> 
                        <a id="default-content" class="nav-link main-tabgroup" onclick="displayContent(event, 'artworks')">Artworks</a>
                    </li>
                    <li class="nav-item mx-2 mb-2 mb-md-4">
                        <a class="nav-link main-tabgroup" onclick="displayContent(event, 'events')">Events</a>
                    </li>
                    <li class="nav-item mx-2 mb-2 mb-md-4">
                        <a class="nav-link main-tabgroup" onclick="displayContent(event, 'about')">About</a>
                    </li>
                </ul>
            </div>
    
            <div id="artworks" class="tabcontent mb-5">

                <div class="row justify-content-center">
                    <div class="col-lg-6 offset-lg-6 text-end">
                        @if (Auth::check() && (Auth::user()->id == $user->id))
                            <button type="button" class="btn btn-outline-dark btn-block rounded-pill mt-5" onclick="window.location.href='{{ route('user.add_artwork', Auth::user()->id) }}';"><i class="fa-solid fa-plus"></i> Add More Wonderful Pieces!!</button>    
                        @endif
                    </div>
                </div>

                <div class=" mt-3 mx-4 row row-cols-1 row-cols-md-3 g-4">
                    <script>
                        var countId = 0;
                    </script>
                    @foreach ($artworks as $artwork)
                        <div class="col-lg-4 col-md-6 col-sm-12" id="artist-artwork">
                            <script>
                                artworkId = document.getElementById('artist-artwork').id;
                                artworkId += countId;
                                document.getElementById('artist-artwork').id = artworkId;
                            </script>
                            <div class="card h-100">
                                <img src="{{ $artwork->asset->asset_url }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $artwork->title }}</h5>
                                    <p class="card-text">{{ $artwork->description }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex">
                                        <small class="text-muted">Votes: </small>
                                        <!-- FIGURE OUT HOW TO DO IT WITHOUT INLINE STYLR -->
                                        <small class="text-muted"><span style="margin-left:5px;">{{ $artwork->votes }}</span></small>
                                    </div>

                                    {{-- START OF POPUP --}}
                                    {{-- <div class="row">
                                        <button class="btn btn-dark rounded-pill btn-block mt-4 text-end col-lg-4"  type="submit">
                                            <a href="#" class="cd-popup-trigger text-decoration-none text-white" id="popup">Details</a>
                                        </button>
                                    </div>

                                    <script>
                                        popupId = document.getElementById('popup').id;
                                        popupId += countId;
                                        document.getElementById('popup').id = popupId;
                                    </script>

                                    <div class="cd-popup" role="alert">
                                        <div class="cd-popup-container">
                                            <div class="card h-50">
                                                <img src="{{ $artwork->asset->asset_url }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $artwork->title }}</h5>
                                                    <p class="card-text">{{ $artwork->description }}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="d-flex">
                                                        <small class="text-muted">Votes: </small>
                                                        <small class="text-muted"><span style="margin-left:5px;">{{ $artwork->votes }}</span></small>
                                                    </div>
                                              </div>
                                                <ul class="cd-buttons">
                                                    <li><a href="#">Edit</a></li>
                                                    <li><a href="#">Delete</a></li>
                                                </ul>
                                                <a href="#" class="cd-popup-close img-replace">Close</a>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- END OF POPUP --}}
                                    @if (Auth::check() && (Auth::user()->id == $user->id))
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4 text-end">
                                                <form action="{{ route('user.edit_artwork', ['user_id'=>Auth::user()->id, 'artwork_id'=>$artwork->id]) }}" method="get">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-dark btn-block rounded-pill mt-5">Edit this piece?</button>
                                                </form>
                                            </div>
                                            <div class="col-lg-4 text-end">
                                                <form action="{{ route('user.delete_artwork', ['user_id'=>Auth::user()->id, 'artwork_id'=>$artwork->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-dark btn-block rounded-pill mt-5">Delete this piece?</button>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        <script>
                            countId++;
                        </script>
                    @endforeach
        
                    <div class="spacing"><br></div>
                </div>
            </div>
    
            <div id="events" class="tabcontent">

                <div class="row justify-content-center">

                    @if (Auth::check() && (Auth::user()->id == $user->id))

                        <div class="col-lg-6 offset-lg-6 text-end">
                            <div class="artist-events event-btn" style="display: inline-block">
                                <button type="button" class="btn btn-outline-dark btn-block rounded-pill" onclick="window.location.href='{{ route('user.add_event', Auth::user()->id) }}';">Join an event here!!</button>
                            </div>
                            <div class="event-btn" style="display: inline-block; padding">
                                <button type="button" class="btn btn-outline-dark btn-block rounded-pill" onclick="window.location.href='{{ route('user.destroy_event', Auth::user()->id) }}';">Leave an event...</button>
                            </div>
                        </div>

                    @endif
                    
                </div>

                <!--google maps-->
                <div class="m-5">
                    <h4 class="mb-2">No. of Events: <span id="totalEvent"></span></h4>
                    <br>
                    <div id="map" class="mx-3 w-100 border border-dark p-5"></div>
                </div>
    
            </div>
    
            <div id="about" class="tabcontent">
                <div id="artist-bio" class="mt-3 mb-5 mx-4">
                    {{-- <div class="mb-4">
                        <h5>Categories</h5>
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="#">OnlyFans</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Film Star</a>
                            </li>
                          </ul>
                    </div> --}}

                    <div class="text-center">
                        <h2 class="fw-bolder mt-4">Biography</h2>
                        <p class="mx-4 my-2">
                            {{ $user->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        

        <!--google maps script-->
        <script>
            var events_collection = {{ Illuminate\Support\Js::from($events_details) }};
            console.log(events_collection);

            // returning total event the artist is involved in
            var totalEvent = events_collection.length;

            // produce map only if the artist is involved in events
            if (typeof totalEvent == 'number') {
                document.getElementById('totalEvent').innerText = totalEvent;

                // Initialize and add the map
                function initMap() {
                    var events_collection = {{ Illuminate\Support\Js::from($events_details) }};
                    // for (events of events_collection){
                        // console.log(events['museum_name']);
                        // console.log(events['long']);
                        // console.log(events['lat']);
                        // console.log(events['images_list']);
                    // }

                    // Creating map with a view of Singapore
                    var map = new google.maps.Map(
                    document.getElementById('map'), {zoom: 11.5, center: {lat: 1.3521, lng: 103.8198}});

                    // The marker, positioned at museum
                    for (events of events_collection){
                        let marker = new google.maps.Marker({
                        position: {lat: events['lat'], lng: events['long']}, 
                        map: map,
                        title: events['museum_name'],
                        icon:{
                            url:"https://cdn-icons-png.flaticon.com/512/4874/4874738.png",
                            scaledSize: new google.maps.Size(40,40)
                        }
                        });

                    //   Type string here
                        let count = 0;
                        let museum = events['museum_name'];
                        
                        var contentString = `<h5>${museum}</h5>
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">`;

                        let eventsImage = events['images_list'];
                        for (imgLink of eventsImage){
                            if (count == 0){
                                contentString+= `
                                <div class="carousel-item active">
                                <img src="${imgLink}" style="height:250px; width:300px;">
                                </div>`;    
                            } else{
                                contentString += `
                                <div class="carousel-item">
                                <img src="${imgLink}" style="height:250px; width:300px;">
                                </div>
                                `;
                            }
                            count++;
                        }
                        console.log(count);
                        contentString += `
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            </div>`; 

                        // make it on click
                        google.maps.event.addListener(marker, "click", () => {
                            var infowindow = new google.maps.InfoWindow({
                                content: contentString,
                                maxWidth: 300
                                });
                                infowindow.open(map,marker);
                            })
                    };

                    }
                    
                    

            } else {
                document.getElementById('totalEvent').innerText = 0;
            }

           
                
            </script>
            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO3zBsHYh0v5BB1T4mAosSJHNWIxcpk5k&callback=initMap"></script>

            {{-- Tab Scripts --}}
            <script>
                document.getElementById('default-content').click();
                
                function displayContent(e, tabName) {
                    var tabcontent = document.getElementsByClassName('tabcontent');
                    for (var i=0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = 'none';
                    }

                    var maintabs = document.getElementsByClassName('main-tabgroup');
                    for (var i=0; i < maintabs.length; i++) {
                        maintabs[i].classList.remove("active");
                    }

                    document.getElementById(tabName).style.display = "block";
                    e.currentTarget.classList.add('active');
                }
            </script>

            {{-- Artwork Popup Script --}}
            <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

            {{-- <script>
                jQuery(document).ready(function($){

                    //open popup
                    $('.cd-popup-trigger').on('click', function(event){
                        event.preventDefault();
                        $('.cd-popup').addClass('is-visible');
                    });
                    
                    //close popup
                    $('.cd-popup').on('click', function(event){
                        if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
                            event.preventDefault();
                            $(this).removeClass('is-visible');
                        }
                    });
                    //close popup when clicking the esc keyboard button
                    $(document).keyup(function(event){
                        if(event.which=='27'){
                            $('.cd-popup').removeClass('is-visible');
                        }
                    });
                });
            </script> --}}

    </body>
@endsection