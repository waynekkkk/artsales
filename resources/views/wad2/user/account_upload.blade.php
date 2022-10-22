@extends('layouts.app')

@section('content')
    <body>
        <div id="navigation">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                <!-- Navbar content -->
                <div class="container-fluid py-2">
                    <a class="navbar-brand" href="#"><img class="logo-img" src="img/logo.png" alt="State of the Art logo"><span class="ms-3 fw-bold fs-3 ">State of the Art</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <form class=" nav-link d-flex mt-1" role="search">
                                <input class="form-control mx-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-light" type="submit">Search</button>
                            </form>
                        </li>
                        <!-- UNSURE OF HOW TO MAKE THE EXPLORE AND ACCOUNTS BUTTON TO THE RIGHT -->
                        <li>
                            <div class="empty-box"></div>
                        </li>
                        <!-- Right Side -->
                        <li class="nav-item">
                            <a class="nav-link mt-2 btn btn-outline-light mx-3 fs-6" href="#"><i class="fa-solid fa-palette"></i> Explore</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="mt-2 nav-link dropdown-toggle btn btn-light text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> Account
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Log In</a></li>
                            <li><a class="dropdown-item" href="#">Sign Up</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    </div>
                </div>
            </nav>
        </div>

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

        <!-- Upload -->
        <h2 class="text-center mb-3">
            Upload your amazing artworks here!
        </h2>

        <div id="uploadfile"> 
            <form id="file-upload-form" class="uploader">
                <input id="file-upload" type="file" name="fileUpload" accept="image/*" />
              
                <label for="file-upload" id="file-drag">
                  <img id="file-image" src="#" alt="Preview" class="hidden">
                  <div id="start">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <div>Select a file or drag here</div>
                    <div id="notimage" class="hidden">Please select an image</div>
                    <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                  </div>
                  <div id="response" class="hidden">
                    <div id="messages"></div>
                    <progress class="progress" id="file-progress" value="0">
                      <span>0</span>%
                    </progress>
                  </div>
                </label>
              </form>
        </div>

        <script src="upload.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>

    <!-- https://mdbootstrap.com/docs/standard/navigation/footer/ -->
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-light bg-dark">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->
    
        <!-- Right -->
        <div>
            <a href="" class="me-4 text-reset">
            <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="me-4 text-reset">
            <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset">
            <i class="fab fa-github"></i>
            </a>
        </div>
        <!-- Right -->
        </section>
        <!-- Section: Social media -->
    
        <!-- Section: Links  -->
        <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <img class="logo-img mx-auto mb-3"  src="img/logo.png">
                <h6 class="text-uppercase fw-bold mb-4">
                State Of The Art
                </h6>
                <p>
                We believe in art beyond the frames
                </p>
            </div>
            <!-- Grid column -->
    
            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                
            </div>
            <!-- Grid column -->
    
            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                Links
                </h6>
                <p>
                    <a href="#!" class="text-reset">Explore</a>
                </p>
                <p>
                <a href="#!" class="text-reset">Ranking</a>
                </p>
                <p>
                <a href="#!" class="text-reset">Help</a>
                </p>
            </div>
            <!-- Grid column -->
    
            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                <p><i class="fas fa-home me-3"></i> Singapore</p>
                <p>
                <i class="fas fa-envelope me-3"></i>
                info@state.art
                </p>
                <p><i class="fas fa-phone me-3"></i> + 65 6565 6565</p>
            </div>
            <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        </section>
        <!-- Section: Links  -->
    
        <!-- Copyright -->
        <div class="text-center p-4 text-dark" style="background-color: white">
        © 2022 Copyright:
        <a class="text-reset fw-bold" href="#">State of The Art</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

</html>