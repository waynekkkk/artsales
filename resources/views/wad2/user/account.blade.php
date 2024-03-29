@extends('layouts.app')

@section('content')
    <body>
        
        <div id="artist-profile">
            <!-- Dynamic displaying of background img. See mini lab 2 and how they do it -->

            <!-- To make it dynamic and customisable to user -->
            <img id="banner-image" src="{{ $user->banner ? $user->banner->asset_url : asset('images/hero.jpeg') }}" alt="Banner Image">
            
        </div>

        <div class="container">
            <div class="display-pic text-center">
                <!-- Dynamic displaying of dp. Similar to profileBackground --> 
                <!-- Nav bar too.  -->
                <img id="profile-image" src="{{ $user->profile_picture ? $user->profile_picture->asset_url : asset('images/hello-kitty-dancing.gif') }}" alt="Profile Image">
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
                <span id="artist-events" class="text-center me-3">
                    {{ count($museum_artists_involvement) }}<br>
                    <span class="fs-6 fw-normal">Events</span>
                </span>
            </div>
    
            <div id="artist-socials">
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-brands fa-twitter"></i></button>
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-brands fa-instagram"></i></button>
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3 me-3"><i class="social fa-solid fa-envelope"></i></button>
            </div>
    
            <div class="page-feature mb-2">
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
                    <div class="col-lg-6 offset-lg-6 text-center text-md-end">
                        @if (Auth::check() && (Auth::user()->id == $user->id))
                            <button type="button" class="btn btn-outline-dark btn-block btn-sm rounded-pill" onclick="window.location.href='{{ route('user.add_artwork', Auth::user()->id) }}';"><i class="fa-solid fa-plus"></i> Add More Wonderful Pieces!!</button>    
                        @endif
                    </div>
                </div>

                <div class=" mt-3 mx-4 row row-cols-1 row-cols-md-3 g-4" style="margin: 0 auto !important;">
                    @if (count($artworks) == 0)
                        <div class="col-lg-4 col-md-6 d-none d-md-block">

                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="text-center fw-bold">
                                There are currently no artworks...yet!
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 d-none d-md-block">

                        </div>
                    @else
                        <script>
                            var countId = 0;
                        </script>
                        @foreach ($artworks as $artwork)
                            <div class="col-lg-4 col-md-6 col-sm-12">

                                <!-- Modal -->
                                <div class="modal fade" id="artwork-modal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">{{ $artwork->title }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ $artwork->asset->asset_url }}" class="card-img-top">
                                            <hr>
                                            <p class="fw-semibold">{{ $artwork->description }}</p>
                                            <div class="d-flex justify-content-between">
                                                <div class="vote text-muted">
                                                    <small>Votes: {{ $artwork->votes }}</small>
                                                </div>
                                                @if (Auth::check() && !($artwork->artist_id == Auth::user()->id))
                                                    <div class="stage">
                                                        <div class="heart" 
                                                            @if (Auth::check() && !($artwork->artist_id == Auth::user()->id))
                                                                onclick="postLike(event, {{ $artwork->id }}, {{ Auth::user()->id }})"
                                                            @elseif (Auth::check() && ($artwork->artist_id == Auth::user()->id))
                                                                onclick="alert('Oh dear! We know you love your own art, but let\'s be fair!')"
                                                            @else
                                                                onclick="alert('Please log in to start casting your votes!')"
                                                            @endif>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            @if (Auth::check() && (Auth::user()->id == $user->id))
                                            <div class="d-grid gap-2 d-flex justify-content-end">
                                                <form action="{{ route('user.edit_artwork', ['user_id'=>Auth::user()->id, 'artwork_id'=>$artwork->id]) }}" method="get">
                                                    @csrf
                                                    <button type="submit" class="btn btn-light rounded-pill">Edit this piece?</button>
                                                </form>
                                                <form action="{{ route('user.delete_artwork', ['user_id'=>Auth::user()->id, 'artwork_id'=>$artwork->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-pill">Delete master piece? D:</button>
                                                </form>
                                            </div>
                                            {{-- <div class="row">
                                                <div class="col-sm-6">
                                                    <form action="{{ route('user.edit_artwork', ['user_id'=>Auth::user()->id, 'artwork_id'=>$artwork->id]) }}" method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-dark btn-block rounded-pill fs-6">Edit!</button>
                                                    </form>
                                                </div>
                                                <div class="col-sm-6">
                                                    <form action="{{ route('user.delete_artwork', ['user_id'=>Auth::user()->id, 'artwork_id'=>$artwork->id]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-dark btn-block rounded-pill fs-6">Delete?</button>
                                                    </form>
                                                </div>
                                            </div> --}}
                                        @endif
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    artworkModal = document.getElementById('artwork-modal').id;
                                    artworkModal += countId;
                                    document.getElementById('artwork-modal').id = artworkModal;
                                </script>

                                <div class="card h-100 artwork-card">
                                    <img style="cursor: pointer; border-radius:15px 15px 0 0;" id="artist-artwork" src="{{ $artwork->asset->asset_url }}" class="card-img-top" data-bs-target="#artwork-modal" data-bs-toggle="modal">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $artwork->title }}</h5>
                                        <p class="card-text">{{ $artwork->description }}</p>
                                    </div>
                                    <div class="card-text p-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="vote text-muted">
                                                <small>Votes: {{ $artwork->votes }}</small>
                                            </div>
                                            <div>
                                                <button type="button" id="targetArt" class="stage btn btn-white text-end me-2 mb-1 @if (!Auth::check() || (Auth::check() && (Auth::user()->id != $artwork->artist_id))) d-none @endif" data-bs-toggle="modal" data-bs-target="#artwork-modal">
                                                    •••
                                                </button>
                                            </div>
                                            @if (!Auth::check() || (Auth::check() && !($artwork->artist_id == Auth::user()->id)))
                                                <div class="stage">
                                                    <div class="heart" 
                                                        @if (Auth::check() && !($artwork->artist_id == Auth::user()->id))
                                                            onclick="postLike(event, {{ $artwork->id }}, {{ Auth::user()->id }})"
                                                        @elseif (Auth::check() && ($artwork->artist_id == Auth::user()->id))
                                                            onclick="alert('Oh dear! We know you love your own art, but let\'s be fair!')"
                                                        @else
                                                            onclick="alert('Please log in to start casting your votes!')"
                                                        @endif>
                                                    </div>
                                                    
                                                </div>
                                            @endif
                                            
                                        </div>
                                        
                                        <script>
                                            targetModal = document.getElementById('targetArt').id;
                                            artworkId = document.getElementById('artist-artwork').id;
                                            artworkId += countId;
                                            targetModal += countId;
                                            document.getElementById('targetArt').id = targetModal;
                                            document.getElementById('artist-artwork').id = artworkId;
                                            targetModalImg = document.getElementById(artworkId).dataset.bsTarget;
                                            targetModalBtn = document.getElementById(targetModal).dataset.bsTarget;
                                            targetModalImg += countId;
                                            targetModalBtn += countId;
                                            document.getElementById(artworkId).dataset.bsTarget = targetModalImg;
                                            document.getElementById(targetModal).dataset.bsTarget = targetModalBtn;
                                            countId++;
                                        </script>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div id=""></div>
        
                    <div class="spacing"><br></div>
                </div>
            </div>
    
            <div id="events" class="tabcontent">

                <div class="row justify-content-center">

                    @if (Auth::check() && (Auth::user()->id == $user->id))

                        <div class="col-lg-6 offset-lg-6 text-center text-md-end mb-3">
                            <div class="artist-events event-btn" style="display: inline-block">
                                <button type="button" class="btn btn-outline-dark btn-block btn-sm rounded-pill" onclick="window.location.href='{{ route('user.add_event', Auth::user()->id) }}';">Join an event here!!</button>
                            </div>
                            <div class="event-btn" style="display: inline-block; padding">
                                <button type="button" class="btn btn-outline-dark btn-block btn-sm rounded-pill" onclick="window.location.href='{{ route('user.destroy_event', Auth::user()->id) }}';">Leave an event...</button>
                            </div>
                        </div>

                    @endif
                    
                </div>

                <!--google maps-->
                <div class="mx-5 mb-5">
                    <h4>No. of Events: <span id="totalEvent"></span></h4>
                    <br>
                    <div id="map" class="mx-0 mx-sm-3 w-100 border border-dark p-5"></div>
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

            // returning total event the artist is involved in
            var totalEvent = events_collection.length;

            // produce map only if the artist is involved in events
            if (typeof totalEvent == 'number') {
                document.getElementById('totalEvent').innerText = totalEvent;

                // Initialize and add the map
                function initMap() {

                    // Creating map with a view of Singapore
                    var map = new google.maps.Map(
                    document.getElementById('map'), {zoom: 11.5, center: {lat: 1.3521, lng: 103.8198}});

                    // The marker, positioned at museum
                    for (events of events_collection){
                        let marker = new google.maps.Marker({
                        position: {lat: parseFloat(events['lat']), lng: parseFloat(events['long'])}, 
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
                        
                        let contentString = `<h5>${museum}</h5>
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">`;

                        let eventsImage = events['images_list'];
                        for (imgLink of eventsImage){
                            if (count == 0){
                                contentString+= `
                                <div class="carousel-item active">
                                <img src="${imgLink}" style = "height:auto; width:100%;">
                                </div>`;    
                            } else{
                                contentString += `
                                <div class="carousel-item">
                                <img src="${imgLink}" style = "height:auto; width:100%;">
                                </div>
                                `;
                            }
                            count++;
                        }
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
                                if (currentInfoWindow != null) {
                                    currentInfoWindow.close();
                                }
                                infowindow.open(map,marker);
                                currentInfoWindow = infowindow;    
                            })
                        var currentInfoWindow = null;
                    };

                    }
                    
                    

            } else {
                document.getElementById('totalEvent').innerText = 0;
            }

           
                
            </script>
            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMZU_4S6OOzBbyFvBbiU8Kkwq3-fxhwJI&callback=initMap"></script>

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
            
            <script>
                function postLike(event, artwork_id, user_id) {
    
                    if (confirm("Are you sure you want to vote for this artwork?")) {
                        axios.post("/api/artwork/like", {
                                    user_id:        user_id,
                                    artwork_id:     artwork_id
                                })
                        .then(response => {
                            var new_votes = response.data.result;
                            var msg = response.data.message;

                            event.target.classList.add('is-active');
                            event.target.removeAttribute('onclick');

                            var stage_parent = event.target.parentElement;
                            var vote_div = stage_parent.parentElement.childNodes[1];
                            vote_div.innerHTML = `<small>Votes: ${new_votes}</small>`;
                        })
                        .catch(error => {
                            console.log(error.message);
                        })
                    };
                    

                }
            </script>

    </body>
@endsection