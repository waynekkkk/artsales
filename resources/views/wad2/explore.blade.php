@extends('layouts.app')

@section('content')
<body>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.rawgit.com/coderitual/odoo/feature/codevember16/lib/odoo.js"></script>

<style>
        .card_wrapper{
            border-radius: 15px;
        }

        .img_wrapper{
            border-top-left-radius: 13px;
            border-top-right-radius: 13px;
        }

        .grids {
        display: grid;
        justify-content: center;
        }

        /* Screen larger than 768 2 column */
        /* @media (min-width: 860px) {
        .grids { 
            grid-template-columns: repeat(2, 1fr); 
            }
        } */

        /* Screen larger than 960 3 columns */
        @media (min-width: 1330px) {
        .grids { grid-template-columns: repeat(3, 1fr); }
        }
        /* Screen larger than 1200  columns */
        /* @media (min-width: 1800px) {
        .grids { grid-template-columns: repeat(4, 1fr); 
        }
        } */

         /* for infowindow carousel nav button */
    .carousel-control-prev-style{
        left: -30px;
        top:50%;
        position: absolute;
        color: grey;
    }
    .carousel-control-prev-style:hover{
        color: black;
    }
    .carousel-control-next-style{
        right: -30px;
        top:50%;
        position: absolute;
        color: grey;
    }
    .carousel-control-next-style:hover{
        color: black;
    }

    .reveal{
    position: relative;
    transform: translateY(100px);
    opacity: 0;
    transition: 1s all ease;
    }

    .reveal.active{
    transform: translateY(0);
    opacity: 1;
    }

    @keyframes slide-in-left {
    from {
      transform: translateX(-100%);
      opacity: 0;
    }
    to {
      transform: translateX(0%);
      opacity: 1;
    }
  }
  .from-left-3 {
        animation: slide-in-left 1300ms;
    }
    </style>
</head>

<body>
    <div class="container">
        
        <div class="row">
            <div class="container text-center pt-5">
                <h1>Explore incredible art</h1>
            </div>
        </div>
        
        <div class="row">
            <!-- suffle button -->
            <div class="container d-flex justify-content-center pt-3 position-static">
                <button type="button" class="btn btn-dark rounded-pill me-3" onclick="shuffle()">Shuffle Artwork
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.624 9.624 0 0 0 7.556 8a9.624 9.624 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.595 10.595 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.624 9.624 0 0 0 6.444 8a9.624 9.624 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5z"/>
                    <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192zm0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192z"/>
                </svg>
                </button>
            </div>
             <!-- Keep modals for artworks -->
            <div id="artworks_modal"></div>
        </div>
    
        <div class="row">
            <!--card-->
            <div class="" id="artworks">
                <!-- display artworks -->
                <!-- <div class="grids" id="artworks"> -->
                <!-- <h1>not working</h1> -->
                <!-- </div> -->
            </div>
        </div>
        
        <div class="row">
            <!-- google maps -->
            <div class="container mt-5">
                <div class="container text-center pt-3 mb-3 position-static">
                    <h3>Explore our Physical Galleries!</h3>
                    <br>
                    <button type="button" class="btn btn-dark rounded-pill mb-2 me-3" onclick="new_center()">Take me anywhere &nbsp  
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-2" viewBox="0 0 16 16">
                        <path d="M13 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h10zM3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3z"/>
                        <path d="M5.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                    </button>
                </div>
                <!-- roulette -->
                <div class="mb-2">
                    <!-- <div class="js-odoo mb-2" style="font-family: 'Poppins';font-size:2.5vmin;"></div> -->
                    <span class="js-odoo s0" id = 's0' style="font-family: monospace;"></span>
                    <span class="js-odoo s1" id = 's1' style="font-family: monospace;"></span>
                    <span class="js-odoo s2" id = 's2' style="font-family: monospace;"></span>
                    <span class="js-odoo s3" id = 's3' style="font-family: monospace;"></span>
                </div>
                
                <div id="map" class="border border-dark mb-5" style="height: 600px;"></div>
            </div>
        </div>

    </div>

    <script>
        var works = {{ Illuminate\Support\Js::from($all_artworks_by_votes) }};
        var authenticated = {{ Illuminate\Support\Js::from($authenticated) }};

        // slice to random 3 works
        shuffleWork(works)
        three_works = works.slice(0,3)
        showAll(three_works, authenticated)
        reveal()

        // shuffle array of artworks
        function shuffleWork(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // display artworks
        function showAll(array, authenticated){
            
            let artworks = '<div class="grids reveal">'
            let artwork_modal = ""
            array.forEach(artwork => {
                let onclick_content = '';
                if (authenticated && !(artwork.artist_id == authenticated)) {
                    onclick_content = `postLike(event,${artwork.id},${authenticated})`;
                }
                else if (authenticated && (artwork.artist_id == authenticated)) {
                    onclick_content = `alert('Oh dear! We know you love your own art, but let us be fair!')`
                }
                else {
                    onclick_content = `alert('Please log in to start casting your votes!')`
                }
            
                artworks += `
                <div class="card card_wrapper" style="width: auto !important;">
                <img style="cursor: pointer; object-fit:cover; width:100%; height:400px;" data-bs-toggle="modal" data-bs-target="#Modal${artwork.id}" class="card-img-top img_wrapper" src="${artwork.asset_url}" alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title text-center"><strong>${artwork.title}</strong></h3>
                    <p class="fw-light text-center">${artwork.description}</p>
                    <div class="d-flex justify-content-between">
                        <div class="vote">
                            <small>Votes: ${artwork.votes}</small>
                        </div>
                        <div class="stage">
                            <div class="heart"
                                onclick="${onclick_content}">
                            </div>
                        </div>
                    </div>
                </div>
            </div> `
            artwork_modal += `
            <div class="modal fade" id="Modal${artwork.id}">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel${artwork.id}">${artwork.title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <img src="${artwork.asset_url}" style="width: 100%;">
                    </div>
                    <div class="modal-footer">

                    <a href="{{ route('user.account', ':user_id') }}">
                    <button type="button" class="btn btn-dark rounded-pill">View the Artist</button>
                    <a/>
                    </div>
                </div>
                </div>
            </div>
            `
            artwork_modal = artwork_modal.replace(':user_id', artwork.artist_id)
        });
        artworks += "</div>"
        document.getElementById("artworks_modal").innerHTML = artwork_modal
        document.getElementById("artworks").innerHTML = artworks
        }

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
   
        // shuffle button function
        function shuffle(){
            shuffleWork(works)
            three_works = works.slice(0,3)
            showAll(three_works, authenticated)
            reveal()
        }


        // google maps
        var museum_collection = {{ Illuminate\Support\Js::from($museum_collections) }};     
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
    // Initialize and add the map
    function initMap(c_lat = 1.2898, c_lng = 103.8558) {
        // The map, centered at museum
        var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 16, center: new google.maps.LatLng(1.2898,103.8558)});
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
        //   museum background
        var contentString = `
        <div class="container-fluid" style="position:relative; height:200px;">
        <img src="${museum_image[museum.name]}" style="position:relative; height:100%; width:100%; object-fit:cover;">
        <div style = 'position:absolute; bottom:10px; left:30px;color:white; font-size:20px; font-family:poppins; font-weight:bold;'>${museum.name}</div>
        </div>
        `;
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
                contentString += `<br><div style='text-align:center;'><h5 style:'text-align:center;' class='fw-light'>by ${artist.name}</h5></div>`
                contentString += `
                <div id="${artist.name.replaceAll(" ","")}" class="carousel slide" data-bs-ride="carousel" style="margin:10px 40px 10px 40px;">
                    <div class="carousel-inner">`;
                    for (let i = 0; i < artist.images_list.length; i++){
                        if (i == 0){
                            contentString += `
                            <div class="carousel-item active">
                                <img src="${artist.images_list[i]}" style = "height:auto; width:100%;">
                            </div>`;     
                        }else{
                            contentString += `
                                <div class="carousel-item">
                                    <img src="${artist.images_list[i]}" style = "height:auto; width:100%;">
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
         .catch(error => {
         // process error object
         contentString += "<div style='text-align:center; margin-top:10px;'><div style = 'color:black; font-size:20px; font-family:copperplate; font-weight:bold; text-align:center;'><strong>Current Galleries</strong></div></div>"
         museum.artists_list.forEach(artist =>{
                contentString += `<br><div style='text-align:center;'><h5 style:'text-align:center;' class='fw-light'>by ${artist.name}</h5></div>`
                contentString += `
                <div id="${artist.name.replaceAll(" ","")}" class="carousel slide" data-bs-ride="carousel" style="margin:10px 40px 10px 40px;">
                    <div class="carousel-inner">`;
                    for (let i = 0; i < artist.images_list.length; i++){
                        if (i == 0){
                            contentString += `
                            <div class="carousel-item active">
                                <img src="${artist.images_list[i]}" style = "height:auto; width:100%;">
                            </div>`;     
                        }else{
                            contentString += `
                                <div class="carousel-item">
                                    <img src="${artist.images_list[i]}" style = "height:auto; width:100%;">
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
        //end foreach
        var currentInfoWindow = null;
        window.setTimeout(() => {
                                    map.setZoom(18);
                                    map.panTo({lat:c_lat, lng:c_lng});
                                }, 800);


        };


        function new_center(){
            var museum_location = [
                {museum: "National Museum Of Singapore" ,lat: 1.2966, lng: 103.8485,},
                {museum: "Asian Civilisations Museum", lat: 1.2875, lng: 103.8514,},
                {museum: "Art Science Museum", lat: 1.2863, lng: 103.8593,},
                {museum: "National Gallery Singapore" , lat: 1.2902, lng: 103.8515,},
                {museum: "Singapore Art Museum", lat: 1.2974, lng: 103.8507,}
            ];
            var random_museum = museum_location[Math.floor(Math.random()*museum_location.length)];
            var nameArr = random_museum.museum.split(" ")
            window.initMap(random_museum.lat, random_museum.lng)
            // set span to empty
            document.getElementById(`s0`).innerText = ''
            document.getElementById(`s1`).innerText = ''
            document.getElementById(`s2`).innerText = ''
            document.getElementById(`s3`).innerText = ''
            // generate slot animation for each span
            for(var i = 0; i < nameArr.length; i++){
                odoo.default({ el:`.js-odoo.s${i}`, from: '???????', to: nameArr[i], animationDelay: 0 });
            }
            

        }
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script> --}}
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMZU_4S6OOzBbyFvBbiU8Kkwq3-fxhwJI&callback=initMap"></script>
    <script>
        // allow poopover
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

       
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