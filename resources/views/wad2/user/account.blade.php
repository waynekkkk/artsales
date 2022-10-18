@extends('layouts.app')

@section('content')
    <body>
        <div id="artist-profile">
            <!-- Dynamic displaying of background img. See mini lab 2 and how they do it -->

            <!-- To make it dynamic and customisable to user -->
            <img id="banner-image" src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1160&q=80" alt="Banner Image">

            <div class="display-pic text-center">
                <!-- Dynamic displaying of dp. Similar to profileBackground --> 
                <!-- Nav bar too.  -->
                <img id="profile-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU" alt="Profile Image">
            </div>

            <div class="artist-name">
                <p class="my-3 mx-auto text-center fs-2 fw-bold">Titus Low</p>
            </div>

            <div class="artist-stats mx-auto justify-content-center d-flex">
                <span id="artist-artworks" class="text-center">
                    6<br>
                    <span class="fs-6 fw-normal">Artworks</span>
                </span>
                <span id="artist-ranking" class="text-center">
                    1<span class="fs-6">st</span>
                    <br><span class="fs-6 fw-normal">Rank</span>
                </span>
                <span id="artist-events" class="text-center">
                    9<br>
                    <span class="fs-6 fw-normal">Events</span>
                </span>
            </div>

            <div id="artist-socials">
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-brands fa-twitter"></i></button>
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-brands fa-instagram"></i></button>
                <button class="btn btn-outline-dark border-3 rounded-circle ms-3"><i class="social fa-solid fa-envelope"></i></button>
            </div>
        </div>

        <div class="page-feature">
            <ul class="nav nav-pills  nav-black nav-fill">
                <li class="nav-item">
                    <a id="default-content" class="nav-link main-tabgroup" onclick="displayContent(event, 'artworks')">Artworks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main-tabgroup" onclick="displayContent(event, 'events')">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main-tabgroup" onclick="displayContent(event, 'about')">About</a>
                </li>
            </ul>
        </div>

        <div id="artworks" class="tabcontent">
            <div class=" mt-3 mx-4 row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                  <div class="card h-100">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">I Love</h5>
                      <p class="card-text">Singapore's Top OnlyFans Creator</p>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted">Votes: </small>
                      <!-- FIGURE OUT HOW TO DO IT WITHOUT INLINE STYLR -->
                      <small class="text-muted"><span style="margin-left:80%;">1</span></small>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Sugar</h5>
                      <p class="card-text">Singapore's Top OnlyFans Creator</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Votes: </small>
                        <!-- FIGURE OUT HOW TO DO IT WITHOUT INLINE STYLR -->
                        <small class="text-muted"><span style="margin-left:80%;">1</span></small>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Mummy</h5>
                      <p class="card-text">Singapore's Top OnlyFans Creator</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Votes: </small>
                        <!-- FIGURE OUT HOW TO DO IT WITHOUT INLINE STYLR -->
                        <small class="text-muted"><span style="margin-left:80%;">1</span></small>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="spacing"><br></div>
        </div>

        <div id="events" class="tabcontent">
            <!--google maps-->
            <div class="m-5">
                <h4 class="mb-2">Past Events</h4>
                <br>
                <div id="map" class="mx-3 w-100"></div>
            </div>

        </div>

        <div id="about" class="tabcontent">
            <div id="artist-bio" class="mt-3 mb-5 mx-4">
                <div class="mb-4">
                    <h5>Categories</h5>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#">OnlyFans</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Film Star</a>
                        </li>
                      </ul>
                </div>
    
                <div>
                    <h5>Biography</h5>
                    <p class="mx-4 my-2">
                        Titus Low is certainly an impactful social media influencer: he boasts over 500,000, 400,000 and 200,000 followers on TikTok, Twitter and Instagram respectively. The 22-year-old Singaporean also has a notorious OnlyFans account where he first saw his fame rise. And he has been making waves again with recent controversial posts.
                    </p>
                </div>
            </div>
        </div>

        <!--google maps script-->
        <script>
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


            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO3zBsHYh0v5BB1T4mAosSJHNWIxcpk5k&callback=initMap"></script>

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

    </body>
@endsection