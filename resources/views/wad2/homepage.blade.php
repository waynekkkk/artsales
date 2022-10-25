@extends('layouts.app')

@section('content')
<!-- axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<body>
<style>
    .heart {
    cursor: pointer;
    height: 50px;
    width: 50px;
    background-image:url( 'https://abs.twimg.com/a/1446542199/img/t1/web_heart_animation.png');
    background-position: left;
    background-repeat:no-repeat;
    background-size:2900%;
    }

    .heart:hover {
    background-position:right;
    }

    .is_animating {
    animation: heart-burst .8s steps(28) 1;
    }

    @keyframes  heart-burst {
    from {background-position:left;}
    to { background-position:right;}
    }
    
    .card_wrapper{
        border-radius: 15px;
        height: 550px;
        margin: 20px 10px 20px 10px;
        transition: all .2s ease-in-out;
    }

    .card_wrapper:hover{
        transform: scale(1.05); 
    }

    .img_wrapper{
        border-top-left-radius: 13px;
        border-top-right-radius: 13px;
    }

    /* for carousel nav button */
    .owl-carousel .prev-slide{
        left: -37px;
        top:35%;
        position: absolute;
        color: grey;
    }
    .owl-carousel .prev-slide:hover{
        color: black;
    }
    .owl-carousel .next-slide{
        right: -37px;
        top:35%;
        position: absolute;
        color: grey;
    }
    .owl-carousel .next-slide:hover{
        color: black;
    }

    /* for carousel nav button */
    .carousel-control-prev-style{
        left: -20px;
        top:50%;
        position: absolute;
        color: grey;
    }
    .carousel-control-prev-style:hover{
        color: black;
    }
    .carousel-control-next-style{
        right: -20px;
        top:50%;
        position: absolute;
        color: grey;
    }
    .carousel-control-next-style:hover{
        color: black;
    }
    /* body{
        min-width:600px;
    } */

</style>
<body>
    <!--spotlight-->
    <div class="container justify-content-around pt-5">
       
        <div class="row align-items-center">
            <div class="col-0 col-md-2"></div>
            <div class="col-12 col-md-5 mx-auto">
                <h1 class="mb-4">Artist of the Month</h1>
                <h3 class="mb-2">{{ $highest_voted_artwork->title }}</h3>
                <h3 class="mb-3">{{ $highest_voted_artwork->description }}</h3>
                <h5 class="mb-2">by {{ $artist_of_the_month->name }}</h5>
                <div class="col my-3">
                    <button type="button" class="btn btn-dark btn-block rounded-pill me-1" onclick="window.location.href='{{ route('user.account', $artist_of_the_month->id) }}';">Explore</button>
                </div>
            </div>
            <div class="col-12 col-md-5 mx-auto">
                <img src="{{ $highest_voted_artwork_asset }}" class="rounded img-fluid" style="width: 400px;">
            </div>
            <div class="col-0 col-md-2"></div>
        </div>
    </div>
    


    <!--Voting-->
    <div class="container mt-5 mx-5">
        <div class="row justify-content-between align-items-center">
            <div class="col pb-3">
                <h1>Voting</h1>
            </div>
            <!--see more-->
            <div class="col justify-content-end d-flex pb-3">
                <a class="btn border-secondary border rounded-pill" href="{{ route('explore') }}">Discover
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a>
            </div>
            <!--carousel-->
            <div class="d-flex justify-content-center pt-2">
                <div class="owl-carousel owl-theme">

                    @foreach($all_artworks_by_votes as $artwork)
                        <div class="card card_wrapper">

                            <a href="{{ route('user.account', $artwork->artist_id) }}">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="{{ $artwork->asset->asset_url }}" alt="Card image cap">
                                <div class="card-body">

                                    <h3 class="card-title">{{ $artwork->title}}</h3>
                                    <p class="card-text">{{ $artwork->description}}</p>
                                    <div class="d-flex justify-content-end">
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
                                </div>
                            </a>
                            
                        </div> 
                    @endforeach                
                    
                </div>
            </div>

            <!--Recommended-->
    <div class="container mt-5 ">
        <div class="row justify-content-between  align-items-center">
            <div class="col-12 col-lg-4 pb-3">
                <h1>Recommended</h1>
            </div>
            <!--see more-->
            <div class="col-3 justify-content-end d-flex pb-3">
                <a class="btn border-secondary border rounded-pill" href="{{ route('explore') }}">Discover
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a>
            </div>
            <!--carousel-->
            <div class="d-flex justify-content-center pt-2 position-relative">
                <div class="owl-carousel owl-theme">
                    @foreach($all_artworks_by_recommendations as $artwork)
                        <div class="card card_wrapper">

                            <a href="{{ route('user.account', $artwork->artist_id) }}">
                            
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="{{ $artwork->asset->asset_url }}" alt="Card image cap">
                                <div class="card-body">

                                    <h3 class="card-title">{{ $artwork->title}}</h3>
                                    <p class="card-text">{{ $artwork->description}}</p>
                                    <div class="d-flex justify-content-end">
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
                                </div>

                            </a>
                            
                        </div> 
                    @endforeach  

                </div>
            </div>


            <!--google maps-->
            <div class="my-5">
                <h1 class="mb-2">Maps</h1>
                <div id="map" class="w-100"></div>
            </div>

            <!--google maps script-->


<script>

function postLike(event, artwork_id, user_id) {

    confirm("Are you sure you want to vote for this artwork?");

    axios.post("http://localhost:8000/api/artwork/like", {
                    user_id:        user_id,
                    artwork_id:     artwork_id
                })
        .then(response => {
            var new_votes = response.data.result;
            var msg = response.data.message;

            event.target.classList.remove('heart');
            event.target.classList.add('text-success');
            event.target.innerText = msg;

            console.log(response.data.message);
        })
        .catch(error => {
            console.log(response.data.message);
        })

}

var museum_collection = {{ Illuminate\Support\Js::from($museum_collections) }};      
    // Initialize and add the map
    var weather_icons = {
        "thunderstorm":"http://openweathermap.org/img/wn/11d@2x.png",
        "drizzle":"http://openweathermap.org/img/wn/09d@2x.png",
        "rain":"http://openweathermap.org/img/wn/10d@2x.png",
        "snow":"http://openweathermap.org/img/wn/13d@2x.png",
        "clear":"http://openweathermap.org/img/wn/01d@2x.png",
        "clouds":"http://openweathermap.org/img/wn/02d@2x.png",
        "mist":"http://openweathermap.org/img/wn/50d@2x.png",
        "smoke":"http://openweathermap.org/img/wn/50d@2x.png",
        "haze":"http://openweathermap.org/img/wn/50d@2x.png",
        "dust":"http://openweathermap.org/img/wn/50d@2x.png",
        "fog":"http://openweathermap.org/img/wn/50d@2x.png",
        "sand":"http://openweathermap.org/img/wn/50d@2x.png",
        "ash":"http://openweathermap.org/img/wn/50d@2x.png",
        "squall":"http://openweathermap.org/img/wn/50d@2x.png",
        "tornado":"http://openweathermap.org/img/wn/50d@2x.png",
    }
    function initMap() {
        // The map, centered at museum
        var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 18, center: new google.maps.LatLng(1.2966, 103.8485)});
        museum_collection.forEach(museum =>{       
        // The location of museum
        var location = {lat: parseFloat(museum.lat), lng: parseFloat(museum.long)};

        // The marker, positioned at museum
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            title: "Event Today",
            icon:{
                url:"https://www.freeiconspng.com/thumbs/museum-icon/art-history-museum-icon--4.png",
                scaledSize: new google.maps.Size(40,40)
            }
        });
        //   Type string here
        var contentString = "<h3 style = 'display:inline;'>" + museum.name + "</h3>";

        // make it have weather info
        var key = "19c53dfa53a7b4e96f444976cf4f5152"
        var url = "https://cors-anywhere.herokuapp.com/https://api.openweathermap.org/data/2.5/weather"
        var param = {
            lat:museum.lat,
            lon:museum.long,
            appid:key
        }
        
        axios.get(url,{params:param})
        .then(response => {
            // process response.dataobject
            var weather = response.data.weather[0].main
            contentString += "<img src='" + weather_icons[weather.toLowerCase()] + "' style='width:38px;'>";
            museum.artists_list.forEach(artist =>{
                contentString += `<h5>${artist.name}</h5>`
                contentString += `
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="margin:10px 40px 10px 40px;">
                    <div class="carousel-inner">`;
                    for (let i = 0; i < artist.images_list.length; i++){
                        if (i == 0){
                            contentString += `
                            <div class="carousel-item active">
                                <img src="${artist.images_list[i]}" style = "height:400px; width:400px;">
                            </div>`;     
                        }else{
                            contentString += `
                                <div class="carousel-item">
                                    <img src="${artist.images_list[i]}" style = "height:400px; width:400px;">
                                </div>`;     
                            }
                        }
                        
                    contentString += `
                    </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon carousel-control-prev-style">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon carousel-control-next-style">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>`; 
                });
            })                   
            // console.log(contentString)
         .catch(error => {
         // process error object
             return error.message;
         }); 
        // make it on click
        google.maps.event.addListener(marker, "click", () => {
            var infowindow = new google.maps.InfoWindow({
                content: contentString
                });
                    
                infowindow.open(map,marker);
            })
        })

        };
var myCarousel = document.querySelector('#myCarousel')
var carousel = new bootstrap.Carousel(myCarousel)

</script>

<!-- <owlcarousel -->
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<script>
    // $('.owl-carousel').owlCarousel({
    //     margin:35,
    //     loop:true,
    //     autoWidth:true,
    //     items:4
        
    // })
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        margin: 40,
        loop: false,
        navText:[`
        <div class='nav-btn prev-slide'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
        </div>`,`
        <div class='nav-btn next-slide'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </div>`],
        responsive: {
        1: {
            items: 1,
            nav: true
        },
        600: {
            items: 2,
            nav: true
        },
        1000: {
            items: 3,
            nav: true,
        }
        }
    })

</script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO3zBsHYh0v5BB1T4mAosSJHNWIxcpk5k&callback=initMap">
    </script>
    
</body>
@endsection