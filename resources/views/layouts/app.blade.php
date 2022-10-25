<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'State Of The Art') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/5054794287.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('images/logo.ico') }}" type="image/x-icon">

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark shadow">
            <div class="container">
                
                <a class="navbar-brand" href="{{ route('home') }}">
                    <span id="nav-sot">STATE OF THE </span> <span id="nav-art"> ART </span>
                    {{-- <span class="ms-4 fw-bold fs-3 ">State of the Art</span> --}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse me-auto" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{-- @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('add') }}">{{ __('Add Vehicle') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('delete_id') }}">{{ __('Delete Vehicle') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('edit_particulars', Auth::user()->id) }}">{{ __('Edit Details') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('add_new_gallery') }}">{{ __('Create a new gallery') }}</a>
                            </li>
                        @endif --}}
                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ms-auto">
                        <a class="nav-link my-2 mx-2 fs-6 text-light" href="{{ route('home') }}"> <span class="underlineHover">Home</span></a>
                        <a class="nav-link my-2 mx-2 fs-6 text-light" href="{{ route('explore') }}"> <span class="underlineHover">Explore</span></a>
                        <a class="nav-link my-2 mx-2 fs-6 text-light" href="{{ route('about_us') }}"><span class="underlineHover"> About Us</span></a>

                        {{-- <a class="nav-link mt-2 btn btn-light mx-2 fs-6 text-dark" href="#"><i class="fa-solid fa-palette"></i> Explore</a>
                        <a class="nav-link mt-2 btn btn-light mx-2 fs-6 text-dark" href="#"> About Us</a>
                         --}}


                        <!-- Authentication Links -->
                        {{-- @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                    
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" style="background-color: #ff2800" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                        @endguest --}}

                        <li class="nav-item dropdown my-auto">
                            @if (Auth::check())
                                <div id="click-out"></div>
                                <a class="my-1 my-sm-0 mx-2 nav-link dropdown-toggle btn text-light my-auto" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="rounded-circle display-pic me-2" src="{{ Auth::user()->profile_picture ? Auth::user()->profile_picture->asset_url : '' }}" alt="" style="width: 30px">{{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item py-2" href="{{ route('user.account', Auth::user()->id) }}">Account</a></li>
                                    {{-- to include activity here --}}
                                    <li><a class="dropdown-item py-2" href="{{ route('user.notifications', Auth::user()->id) }}">Activity</a></li> 

                                    

                                    <li><hr class="dropdown-divider m-0"></li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                <i class="fa-solid fa-right-from-bracket"></i> 
                                                {{ __('Logout') }}

                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>

                                </ul>
                            @else
                                <a class="my-1 my-sm-0 nav-link dropdown-toggle btn text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i> Guest
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item py-2" href="{{ route('login') }}">Log In</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('register') }}">Sign Up</a></li>
                                    <li><hr class="dropdown-divider m-0"></li>
                                    <li><a class="dropdown-item py-2" href="#">Something else here</a></li>
                                </ul>
                            @endif
                            
                        </li>

                    </ul>

                </div>
            </div>
        </nav>

    {{-- <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-light shadow" style="background-color: #ff2800">
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('add') }}">{{ __('Add Vehicle') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('delete_id') }}">{{ __('Delete Vehicle') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('edit_particulars', Auth::user()->id) }}">{{ __('Edit Details') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('add_new_gallery') }}">{{ __('Create a new gallery') }}</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                    
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" style="background-color: #ff2800" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="py-0">
           
            @yield('content')
            
        </main>
    </div>

</body>

<footer class="text-center text-lg-start bg-light text-light bg-dark p-1">  
    <!-- Section: Links  -->
    <section class="" p-5>
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row p-3">
          <!-- Grid column -->
          <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <!-- Content -->
            <h5 class="text-uppercase fw-bold">
                State Of The Art
            </h5>
            <p>
              State of the Art was founded by a group of four monkeys as part of their coding project. They were unified by one common purpose - to bring art to everyone, everywhere, beyond the frames.
            </p>
          </div>
          <!-- Grid column -->
          <div class="col-sm-3 col-md-4 mx-auto mb-md-0"></div>
  
          <!-- Grid column -->
          <div class="col-sm-3 col-md-2 mx-auto mb-md-0">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold my-2">Company</h6>
            <a class="text-light" href="{{ route('home') }}"> <span class="underlineHover"> Home</span></a>
            <br>
            <a class="text-light" href="{{ route('about_us') }}"> <span class="underlineHover"> About Us</span></a>
            <br>
            <a class="text-light" href="#"> <span class="underlineHover"> Explore</span></a>
          </div>

          <div class="col-sm-3 col-md-2 mx-auto mb-md-0">
            <!-- Contact -->
            <h6 class="text-uppercase fw-bold my-2">Contact</h6>
            <a class="text-light" href="#"> <span class="underlineHover"> Facebook</span></a>
            <br>
            <a class="text-light" href="#"> <span class="underlineHover"> Instagram</span></a>
            <br>
            <a class="text-light" href="#"> <span class="underlineHover"> Twitter</span></a>
            <br>
            <a class="text-light" href="#"> <span class="underlineHover"> Email</span></a>
          </div>

          <div class="col-sm-3 col-md-0 mx-auto mb-md-0"></div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>



    <!-- Copyright -->
      <div class="text-center p-2" style="color: white;">
        © 2022 Copyright: State of The Art
      </div>
    <!-- Copyright -->

    </section>

  </footer>
  <!-- Footer -->

</html>
