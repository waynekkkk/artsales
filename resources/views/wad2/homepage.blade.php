@extends('layouts.app')

@section('content')
<!-- axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<body>
    <!--spotlight-->

    
    <div class="container d-flex justify-content-between pt-5 mx-auto">
        <div class="row justify-content-md-between w-100"> 
            <div class="d-flex align-items-center text-center text-md-start justify-content-center mb-3 col-12 col-md-6">
                <div class="">
                    <div class="from-left-1" style="font-size: 48px; font-weight: bold;" > Singapore's <span id="first"> First</span>  Digital Art Musuem</div>
                    <h2 class="mb-2 mt-3 from-left-2">Artwork of the Month</h2>
                    <div class="mb-2 from-left-3" style="font-size: 22px;">
                        <strong>{{ $highest_voted_artwork->title }}</strong> 
                        <span class="fw-light" style="font-size: 16px;">by {{ $artist_of_the_month->name }}</span>
                    </div>
                    {{-- <h3 class="mb-3 from-left-3">{{ $highest_voted_artwork->description }}</h3> --}}
                    <div class="col mt-3 from-left-4 justify-content-center">
                        <button type="button" class="btn btn-dark btn-block rounded-pill me-1 from-left-4 fs-5" onclick="window.location.href='{{ route('user.account', $artist_of_the_month->id) }}';">Explore the artist!</button>
                    </div>
                </div>
            </div>
            <div class="d-flex col-12 col-md-5 justify-content-center mt-3">
                <img src="{{$highest_voted_artwork->asset->asset_url}}" class="rounded img-fluid display from-right spotlight" style="width: 100%; object-fit:contain; filter: drop-shadow(1rem 1rem 0.25rem rgba(0, 0, 0, 0.4));">
            </div>
        </div>
    </div>  
    


    <!--Voting-->
    <div class="container mt-5 mx-auto">
        <div class="row justify-content-between align-items-center">
            <div class="col pb-3">
                <h1 style="font-weight: bold;">Voting</h1>
            </div>
            <!--see more-->
            <div class="col justify-content-end d-flex pb-3">
                <a class="btn border-secondary border rounded-pill" href="{{ route('explore') }}">Discover more
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a>
            </div>
        </div>
            <!--carousel-->
            <div class="d-flex justify-content-center pt-2" style="margin-left: 30px; margin-right:30px;">
                <div class="owl-carousel owl-theme d-flex-justify-content-center w-100">

                    @foreach($all_artworks_by_votes as $artwork)
                        <div class="card card_wrapper" style="max-width: 400px;">

                            <!-- <a href="{{ route('user.account', $artwork->artist_id) }}"> -->
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#ModalLabel{{$artwork->id}}" class="card-img-top img_wrapper" src="{{ $artwork->asset->asset_url }}" alt="Card image cap">
                            <!-- </a> -->   
                            <div class="card-body">
                                <h3 class="card-title"><strong>{{ $artwork->title}}</strong></h3>
                                <p class="card-text mb-3">
                                    <span class="fw-semibold d-block">By: <a href="{{ route('user.account', $artwork->artist_id) }}"><u>{{$artwork->artist->name}}</u></a></span>
                                    <div class="fw-light" style="height:50px;">{{ $artwork->description}}</div>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div class="vote">
                                        <small>Votes: {{ $artwork->votes }}</small>
                                    </div>
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
                                </div>
                            </div>

                        </div> 
                    @endforeach                
                    
                </div>
            </div>
    </div>
            
            

            <!--Recommended-->
    <div class="container mt-5 reveal">
        <div class="row justify-content-between  align-items-center">
            <div class="col pb-3">
                <h1 style="font-weight: bold;">Recommended</h1>
            </div>
            <!--see more-->

            <div class="col justify-content-end d-flex pb-3">
            <a class="btn border-secondary border rounded-pill" href="{{ route('explore') }}">Discover more

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a>
            </div>
        </div>
            <!--carousel-->
            <div class="d-flex justify-content-center pt-2" style="margin-left: 30px; margin-right:30px;">
                <div class="owl-carousel owl-theme w-100">
                    @foreach($all_artworks_by_recommendations as $artwork)
                        <div class="card card_wrapper">

                            <!-- <a href="{{ route('user.account', $artwork->artist_id) }}"> -->
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#ModalLabel{{$artwork->id}}" class="card-img-top img_wrapper" src="{{ $artwork->asset->asset_url }}" alt="Card image cap">
                            <!-- </a> -->
                            <div class="card-body">
                            <h3 class="card-title" id="textFitting"><strong>{{ $artwork->title}}</strong></h3>
                                <p class="card-text fw-light">
                                    <span class="fw-semibold d-block">By: <a href="{{ route('user.account', $artwork->artist_id) }}"><u>{{$artwork->artist->name}}</u></a></span>
                                    <span class="fw-light">{{ $artwork->description}}</span>
                                </p>
                                <div class="d-flex justify-content-end">
                                    <div class="vote">
                                        <small>Votes: {{ $artwork->votes }}</small>
                                    </div>
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
                                </div>
                            </div>
                        </div>
                            
                    @endforeach  

                </div>
            </div>
    </div>

<!-- modal holder -->
<div>
  @foreach($all_artworks_by_votes as $artwork)
      <div class="modal fade" id="ModalLabel{{$artwork->id}}">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel{{$artwork->id}}">{{$artwork->title}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                  <img src="{{$artwork->asset->asset_url}}" style="width: 100%;">
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-light rounded-pill me-3" data-bs-dismiss="modal">Nope</button>
                  <a href='http://127.0.0.1:8000/user/{{$artwork->artist_id}}/account'>
                  <button type="button" class="btn btn-dark rounded-pill">Who?!?!</button>
                  <a/>
                  </div>
              </div>
          </div>
      </div>
  @endforeach 
  </div>
        

        <!--google maps-->
        <div class="container">
            <div class="my-5 reveal">
                <h1 class="mb-3" style="font-weight: bold;">Maps</h1>
                <div id="map" class="border border-dark" style="height: 600px;"></div>
            </div>
        </div>

        <!--google maps script-->


<script>


// for heart vote button

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

            console.log(response.data.message);
        })
        .catch(error => {
            console.log(response.data.message);
        })
    };

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
        var museum_image = {
            "National Museum of Singapore":"https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_720/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/e75d2145-National-Museum-of-Singapore/NationalMuseumofSingapore.jpg",
            "Asian Civilisations Museum":"https://media.tacdn.com/media/attractions-splice-spp-674x446/06/f1/36/5b.jpg",
            "ArtScience Museum":"https://images.fineartamerica.com/images-medium-large-5/artscience-museum-singapore-john-harper.jpg",
            "National Gallery Singapore":"https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_720/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/a7af46f6-%E6%96%B0%E5%8A%A0%E5%9D%A1%E5%9B%BD%E5%AE%B6%E7%BE%8E%E6%9C%AF%E9%A6%86---Klook%E5%AE%A2%E8%B7%AF/NationalGallerySingapore.jpg",
            "Singapore Art Museum":"https://www.artnews.com/wp-content/uploads/2020/12/about-1920px-x-960px.png"
        }
        museum_collection.forEach(museum =>{       
        // The location of museum
        var location = {lat: parseFloat(museum.lat), lng: parseFloat(museum.long)};

        // The marker, positioned at museum
        var marker = new google.maps.Marker({
            position: location, 
            map: map,
            title: "Event Today",
            icon:{
                url:"https://cdn-icons-png.flaticon.com/512/4874/4874738.png",
                scaledSize: new google.maps.Size(40,40)
            }
        });
        //   Type string here
        var contentString = `
        <div class="container-fluid" style="position:relative; height:200px;">
        <img src="${museum_image[museum.name]}" style="position:relative; height:100%; width:100%; object-fit:cover;">
        <div style = 'position:absolute; bottom:10px; left:30px;color:white; font-size:20px; font-family:poppins; font-weight:bold;'>${museum.name}</div>
        </div>
        `;
        console.log(museum.name)
        // make it have weather info
        var key = "19c53dfa53a7b4e96f444976cf4f5152"
        var url = " https://wadiiproxy.herokuapp.com/https://api.openweathermap.org/data/2.5/weather"
        var param = {
            lat:museum.lat,
            lon:museum.long,
            appid:key,
            units:'metric'
        }
        
        axios.get(url,{params:param})
        .then(response => {
            // process response.dataobject
            var weather = response.data.weather[0].main
            contentString += "<div class='from-left-3'><img class='from-left-1' src='" + weather_icons[weather.toLowerCase()] + "' style='width:38px;'><span>" + response.data.main.temp +"°C</span></div> <div style='text-align:center'><div style = 'color:black; font-size:20px; font-family:copperplate; font-weight:bold; text-align:center;'><strong>Current Galleries</strong></div></div>";
            museum.artists_list.forEach(artist =>{
            console.log(artist.name)
                contentString += `<br><div style='text-align:center;'><h5 style:'text-align:center;' class='fw-light'>by ${artist.name}</h5></div>`
                contentString += `
                <div id="${artist.name.replaceAll(" ","")}" class="carousel slide" data-bs-ride="carousel" style="margin:10px 40px 10px 40px;">
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#${artist.name.replaceAll(" ","")}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon carousel-control-prev-style">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#${artist.name.replaceAll(" ","")}" data-bs-slide="next">
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
         contentString += "<div style='text-align:center; margin-top:10px;'><div style = 'color:black; font-size:20px; font-family:copperplate; font-weight:bold; text-align:center;'><strong>Current Galleries</strong></div></div>"
         museum.artists_list.forEach(artist =>{
            console.log(artist.name)
                contentString += `<br><div style='text-align:center;'><h5 style:'text-align:center;' class='fw-light'>by ${artist.name}</h5></div>`
                contentString += `
                <div id="${artist.name.replaceAll(" ","")}" class="carousel slide" data-bs-ride="carousel" style="margin:10px 40px 10px 40px;">
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#${artist.name.replaceAll(" ","")}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon carousel-control-prev-style">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                </svg>
                            </span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#${artist.name.replaceAll(" ","")}" data-bs-slide="next">
                            <span class="carousel-control-next-icon carousel-control-next-style">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                </svg>
                            </span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>`; 
                });
         }); 

         
        // make it on click

        google.maps.event.addListener(marker, "click", () => {
            var infowindow = new google.maps.InfoWindow({
                content: contentString
                });
            if (currentInfoWindow != null) {
            currentInfoWindow.close();
            }
            infowindow.open(map, marker);
            currentInfoWindow = infowindow;    
            })
        })
        //end of foreach museum_collection
        var currentInfoWindow = null;
        };
var myCarousel = document.querySelector('#myCarousel')
// var carousel = new bootstrap.Carousel(myCarousel)

// </script>

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
        margin: 30,
        loop: true,
        center:true,
        autoWidth:true,
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
        // items:2,
        responsive: {
        0: {
            items: 1,
            nav: true,
        },
        1000: {
            items: 2,
            nav: true,
        },
        1300: {
            items: 3,
            nav: true,
        }
        }
    })

    // reveal js
    function reveal() {
    var reveals = document.querySelectorAll(".reveal");

    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 150;

        if (elementTop < windowHeight - elementVisible) {
        reveals[i].classList.add("active");
        } else {
        reveals[i].classList.remove("active");
        }
    }
    }
    window.addEventListener("scroll", reveal);

</script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO3zBsHYh0v5BB1T4mAosSJHNWIxcpk5k&callback=initMap">
    </script>
    
</body>
@endsection