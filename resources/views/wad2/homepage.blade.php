@extends('layouts.app')

@section('content')
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
            margin-bottom: 50px;
        }

        .img_wrapper{
            border-top-left-radius: 13px;
            border-top-right-radius: 13px;
        }
        /* for carousel nav button */
        .owl-carousel .prev-slide{
            border: 2px solid;
            border-radius: 50%;
            padding: 5px;
            background: white;
            left: -37px;
            top:35%;
            position: absolute;
            color: grey;
        }
        .owl-carousel .prev-slide:hover{
            color: black;
        }
        .owl-carousel .next-slide{
            border: 2px solid;
            border-radius: 50%;
            padding: 5px;
            background: white;
            right: -37px;
            top:35%;
            position: absolute;
            color: grey;
        }
        .owl-carousel .next-slide:hover{
            color: black;
        }

    </style>
    <body>
        <!--spotlight-->
        <div class="container pt-5">
            <div class="row"> 
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="">
                        <h1>Artist of the Month</h1>
                        <h2>This is a description of the test artwork 2.</h2>
                        <h3>by Wayne Khoo</h3>
                        <div class="col mt-3">
                            <button type="button" class="btn btn-dark btn-block rounded-pill me-1" onclick="window.location.href='http://127.0.0.1:8000/user/1/account';">Explore</button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <img src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" class="rounded w-50 img-fluid">
                </div>
            </div>
        </div>
      

        

        <!--Voting-->
        <div class="container mt-5 position-relative">
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
                    <a class="btn border-secondary border rounded-pill">Discover more
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                </div>
                <!--carousel-->
                <div class="d-flex justify-content-center pt-2">
                    <div class="owl-carousel owl-theme">
                                                    <!-- <div class="item">
                                <div style="width: 200px;">
                                    <img src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                    <div class="container border">
                                        <h2>Test Artwork 2</h2>
                                        <p>This is a description of the test artwork 2.</p>
                                        <div class="container justify-content-end d-flex">
                                            <button class="btn border border-dark rounded-circle border-3 mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">Test Artwork 2</h3>
                                    <p class="card-text">This is a description of the test artwork 2.</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                                    <!-- <div class="item">
                                <div style="width: 200px;">
                                    <img src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                    <div class="container border">
                                        <h2>Test Artwork</h2>
                                        <p>This is a description of the test artwork.</p>
                                        <div class="container justify-content-end d-flex">
                                            <button class="btn border border-dark rounded-circle border-3 mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">Test Artwork</h3>
                                    <p class="card-text">This is a description of the test artwork.</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                                    <!-- <div class="item">
                                <div style="width: 200px;">
                                    <img src="https://stateoftheart.blob.core.windows.net/wad2/393762818.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                    <div class="container border">
                                        <h2>YouTube Artwork</h2>
                                        <p>bestest channel</p>
                                        <div class="container justify-content-end d-flex">
                                            <button class="btn border border-dark rounded-circle border-3 mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/393762818.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">YouTube Artwork</h3>
                                    <p class="card-text">bestest channel</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                                    <!-- <div class="item">
                                <div style="width: 200px;">
                                    <img src="https://stateoftheart.blob.core.windows.net/wad2/347459043.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                    <div class="container border">
                                        <h2>Test 1080</h2>
                                        <p>test 1080</p>
                                        <div class="container justify-content-end d-flex">
                                            <button class="btn border border-dark rounded-circle border-3 mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:370px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/347459043.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">Test 1080</h3>
                                    <p class="card-text">test 1080</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                                
                        
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
                <div class="d-flex justify-content-center pt-2 position-relative">
                    <div class="owl-carousel owl-theme">
                                                <!-- <div class="item">
                            <div style="width: 200px;">
                                <img src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                <div class="container border">
                                    <h2>Test Artwork 2</h2>
                                    <p>This is a description of the test artwork 2.</p>
                                    <div class="container justify-content-end d-flex">
                                        <button class="btn border border-dark rounded-circle border-3 mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:350px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">Test Artwork 2</h3>
                                    <p class="card-text">This is a description of the test artwork 2.</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                                <!-- <div class="item">
                            <div style="width: 200px;">
                                <img src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                <div class="container border">
                                    <h2>Test Artwork</h2>
                                    <p>This is a description of the test artwork.</p>
                                    <div class="container justify-content-end d-flex">
                                        <button class="btn border border-dark rounded-circle border-3 mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:350px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/logo.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">Test Artwork</h3>
                                    <p class="card-text">This is a description of the test artwork.</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                                <!-- <div class="item">
                            <div style="width: 200px;">
                                <img src="https://stateoftheart.blob.core.windows.net/wad2/393762818.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                <div class="container border">
                                    <h2>YouTube Artwork</h2>
                                    <p>bestest channel</p>
                                    <div class="container justify-content-end d-flex">
                                        <button class="btn border border-dark rounded-circle border-3 mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:350px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/393762818.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">YouTube Artwork</h3>
                                    <p class="card-text">bestest channel</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                                <!-- <div class="item">
                            <div style="width: 200px;">
                                <img src="https://stateoftheart.blob.core.windows.net/wad2/347459043.png" style="width:100%; border-radius:25px 25px 0px 0px">
                                <div class="container border">
                                    <h2>Test 1080</h2>
                                    <p>test 1080</p>
                                    <div class="container justify-content-end d-flex">
                                        <button class="btn border border-dark rounded-circle border-3 mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card card_wrapper">
                                <img style="cursor: pointer; object-fit:cover; width:100%; height:350px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="https://stateoftheart.blob.core.windows.net/wad2/347459043.png" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">Test 1080</h3>
                                    <p class="card-text">test 1080</p>
                                    <div class="d-flex justify-content-end">
                                        <div class="heart"></div>
                                    </div>
                                </div>
                            </div> 
                                            </div>
                </div>


                <!--google maps-->
                <div class="my-5">
                    <h1 class="mb-2">Maps</h1>
                    <div id="map" class="w-100"></div>
                </div>
                
                

                <!--google maps script-->
                <script>
                    var museum_collection = JSON.parse('[{\u0022name\u0022:\u0022National Museum of Singapore\u0022,\u0022long\u0022:\u0022103.84850000\u0022,\u0022lat\u0022:\u00221.29660000\u0022,\u0022artists_list\u0022:[{\u0022name\u0022:\u0022Wayne Khoo\u0022,\u0022start_date\u0022:\u00222022-11-15T00:00:00.000000Z\u0022,\u0022start_end\u0022:\u00222022-11-16T00:00:00.000000Z\u0022,\u0022images_list\u0022:[\u0022https:\\\/\\\/stateoftheart.blob.core.windows.net\\\/wad2\\\/logo.png\u0022,\u0022https:\\\/\\\/stateoftheart.blob.core.windows.net\\\/wad2\\\/logo.png\u0022,\u0022https:\\\/\\\/stateoftheart.blob.core.windows.net\\\/wad2\\\/393762818.png\u0022,\u0022https:\\\/\\\/stateoftheart.blob.core.windows.net\\\/wad2\\\/347459043.png\u0022]}]}]');
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
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
              </div>`,`
              <div class='nav-btn next-slide'>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
              </div>`],
              responsive: {
                0: {
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