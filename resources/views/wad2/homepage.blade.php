@extends('layouts.app')

@section('content')
    <body>
        <!--spotlight-->
        <div class="container pt-5">
            <div class="row"> 
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="">
                        <h1>Artist of the Month</h1>
                        <h2>{{ $highest_voted_artwork->description }}</h2>
                        <h3>by {{ $artist_of_the_month->name }}</h3>
                        <div class="col mt-3">
                            <button type="button" class="btn btn-dark btn-block rounded-pill me-1" onclick="window.location.href='{{ route('user.account', $artist_of_the_month->id) }}';">Explore</button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <img src="{{ $highest_voted_artwork_asset }}" class="rounded w-50 img-fluid">
                </div>
            </div>
        </div>

        

        <!--Voting-->
        <div class="container mt-5 ">
            <div class="row justify-content-between  align-items-center">
                <div class="col-12 col-lg-4 pb-3">
                    <h1>Voting</h1>
                </div>
                <!--radio group-->
                <div class="col-3  d-flex pb-3">
                    <div class="radio_background">
                        <input type="radio" value="value1" name="radio_group" id="button1" class="radio_hide" checked>
                        <label for="button1" class="radio_style">Trending</label>
                        <input type="radio" value="value2" name="radio_group" id="button2" class="radio_hide">
                        <label for="button2" class="radio_style">New</label>
                    </div>
                </div>
                <!--see more-->
                <div class="col-3 justify-content-end d-flex pb-3">
                    <a class="btn border-secondary border rounded-pill" href="images/img1.jpg">Discover more
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                </div>
                <!--carousel-->
                <div class="d-flex justify-content-center pt-2">
                    <div class="owl-carousel owl-theme">
                        @foreach ($all_artworks_by_votes as $artwork_votes)
                            <div class="item">
                                <div style="width: 200px;">
                                    <img src="{{ $artwork_votes->asset->asset_url }}" style="width:100%; border-radius:25px 25px 0px 0px">
                                    <div class="container border">
                                        <h2>{{ $artwork_votes->title }}</h2>
                                        <p>{{ $artwork_votes->description }}</p>
                                        <div class="container justify-content-end d-flex">
                                            <button class="btn border border-dark rounded-circle border-3 mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                <!--radio group-->
                <div class="col-3  d-flex pb-3">
                    <div class="radio_background">
                        <input type="radio" value="value1" name="radio_group2" id="button3" class="radio_hide" checked>
                        <label for="button3" class="radio_style">Trending</label>
                        <input type="radio" value="value2" name="radio_group2" id="button4" class="radio_hide">
                        <label for="button4" class="radio_style">New</label>
                    </div>
                </div>
                <!--see more-->
                <div class="col-3 justify-content-end d-flex pb-3">
                    <a class="btn border-secondary border rounded-pill" href="images/img1.jpg">Discover more
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                </div>
                <!--carousel-->
                <div class="d-flex justify-content-center pt-2">
                    <div class="owl-carousel owl-theme">
                        @foreach ($all_artworks_by_recommendations as $artwork_recommendation)
                        <div class="item">
                            <div style="width: 200px;">
                                <img src="{{ $artwork_recommendation->asset->asset_url }}" style="width:100%; border-radius:25px 25px 0px 0px">
                                <div class="container border">
                                    <h2>{{ $artwork_recommendation->title }}</h2>
                                    <p>{{ $artwork_recommendation->description }}</p>
                                    <div class="container justify-content-end d-flex">
                                        <button class="btn border border-dark rounded-circle border-3 mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


                <!--google maps-->
                <div class="my-5">
                    <h1 class="mb-2">Maps</h1>
                    <div id="map" class="w-100"></div>
                </div>
                
                {{-- <!--Newsletter-->
                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <div class="col-md-6">    
                        <div class="card">    
                            <div class="text-center">
                                <img src="https://static.vecteezy.com/system/resources/previews/000/547/335/original/envelope-mail-icon-vector-illustration.jpg" width="200">
                                <span class="d-block mt-3">Subscribe to our newsletter in order not to miss new artwork</span>
                                <div class="mx-5">
                                <div class="input-group mb-3 mt-4">
                                    <input type="text" class="form-control" placeholder="Enter email" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-dark border-rad" type="button" id="button-addon2">Subscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!--google maps script-->
                <script>
                    var museum_collection = {{ Illuminate\Support\Js::from($museum_collections) }};
                    console.log(museum_collection[0].artists_list[0].images_list[0]);

                    // Initialize and add the map
                    function initMap() {
                        // The location of museum
                        var museum = {lat: 1.2966, lng: 103.8485};
                        // The map, centered at museum
                        var map = new google.maps.Map(
                        document.getElementById('map'), {zoom: 44, center: museum});
                        // The marker, positioned at museum
                        var marker = new google.maps.Marker({
                            position: museum, 
                            map: map,
                            title: "Event Today",
                            icon:{
                                url:"https://www.freeiconspng.com/thumbs/museum-icon/art-history-museum-icon--4.png",
                                scaledSize: new google.maps.Size(40,40)
                            }
                        });
                        //   Type string here
                        const contentString =
                            "<img src='https://assets.teenvogue.com/photos/6154af0f6b45838253b06d59/master/w_1600%2Cc_limit/GettyImages-1343576753.jpg' style='width:160px; height:240px';> <strong>testing testing</strong>"
                        ;
                        // make it on click
                        google.maps.event.addListener(marker, "click", () => {
                            var infowindow = new google.maps.InfoWindow({
                                content: contentString
                                });
                                    
                                infowindow.open(map,marker);
                            })
                        };
                        
                </script>
        
        <!-- <owlcarousel -->
        <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
        <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
        <script>
            $('.owl-carousel').owlCarousel({
                margin:35,
                loop:true,
                autoWidth:true,
                items:4
                
            })
            // var owl = $('.owl-carousel');
            // owl.owlCarousel({
            //   margin: 10,
            //   loop: true,
            //   responsive: {
            //     0: {
            //       items: 1,
            //       nav: true
            //     },
            //     600: {
            //       items: 2,
            //       nav: true
            //     },
            //     1000: {
            //       items: 3,
            //       nav: true
            //     }
            //   }
            // })
    
        </script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO3zBsHYh0v5BB1T4mAosSJHNWIxcpk5k&callback=initMap">
        </script>
    </body>
@endsection