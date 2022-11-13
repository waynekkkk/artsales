@extends('layouts.app')

@section('content')

    {{-- <div class="container-fluid vh-100 bg-overlay">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-8">
                    <h1 class="login-header">
                        Registration
                    </h1>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end" style="font-family: SingaporeSling">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Please enter your name" style="font-family: SingaporeSling">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end" style="font-family: SingaporeSling">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Please enter your email" style="font-family: SingaporeSling">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end" style="font-family: SingaporeSling">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Please enter your desired password" style="font-family: SingaporeSling">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end" style="font-family: SingaporeSling">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Please re-enter your password" style="font-family: SingaporeSling">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="is_artist" class="col-md-4 col-form-label text-md-end" style="font-family: SingaporeSling">{{ __('Are you an artist?') }}</label>

                                <div class="col-md-6">
                                    <select name="is_artist" id="is_artist" class="form-select form-select-md form-select-solid @error('is_artist') is-invalid @enderror" style="font-family: SingaporeSling">
                                        <option disabled selected>Select One</option>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="font-family: SingaporeSling">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div> --}}
{{-- 
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                    
                                    <div class="text-center">
                                        <!-- BRAND LOGO GOES HERE -->
                                        <img src="{{ asset('images/logo.png') }}" style="width: 150px;" alt="logo">
                                        <h3 class="mt-1 mt-5 pb-1">Signup</h3>
                                    </div>
                    
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">What is your name?</label>
                                            <input type="text" id="form2Example10" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                            placeholder="Full Name" />

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="description">Tell us a little more about yourself!</label>
                                            <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="A write-up about yourself...">{{ old('description') }}</textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">What is your email?</label>
                                            <input type="email" id="form2Example11" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                            placeholder="Email address" />

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22">Choose a strong password!</label>
                                            <input type="password" id="form2Example22" class="form-control @error('password') is-invalid @enderror" name="password" />

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                    
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22">Confirm Password</label>
                                            <input type="password" id="form2Example23" class="form-control @error('password_confirmation') is-invalid @enderror"  name="password_confirmation"/>
                                            
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                        
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button type="submit" class="btn btn-danger w-100">
                                                {{ __('Sign Up') }}
                                            </button>                                                
                                        </div>
                        
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Have an existing account? &nbsp; </p>
                                            <button type="button" onclick="window.location.href='{{ route('login') }}';" class="btn btn-outline-danger w-25">Log in</button>
                                        </div>
                                    </form>
                    
                                </div>
                            </div>
                            <div class="bg-secondary col-lg-6 d-flex align-items-center ">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We believe in art beyond the frames</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            
@endsection --}}


<body>
    <div class="outer justify-content-center d-flex">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"> </script>

        {{-- LOG IN  --}}
    <div class="inner">
        
            <section class="login-section">
              <div id="login-container" class="container @error('name') active @enderror @error('email_signup') active @enderror @error('passwordSignup') active @enderror" @error('password_confirmation') active @enderror>
                <div class="user signinBx">
                  <div class="imgBx text-center d-flex"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                    <path id="path-monkey" class="monkey" fill="#fff" stroke="blue" d="M331 439.6H167.5L111 329.4v-50.2L61 227V112h56l133-51.6L380.5 112H439v115l-52.6 55.8v46.6L331 439.6zM179.3 425H319v-38H179.4v38zm-53.5-99l39 75.8V278L138 225.7V168l58.3-57.6 53 26.4 52.5-26.4L361 168v57.8L333.8 278v123.3l38-75.4V124L250 76.2l-124.2 48V326zm53.5 46.3H319v-90.7L249 258l-69.5 23.5v90.8zm69.5-129.8l74 24.8 23.6-45v-48l-47.3-46-49.5 25-50-25L153 174v48.4l23 45 73-24.7zm137.6-115.8v134.7l38-40.3v-94h-38zM75.6 221l35.5 37V126.7H76V221zm142.8 111.8l-25.8-26.6L203 296l26 26.5-10.6 10.3zm62.7 0l-10.4-10.2 25-26.6 10.7 10-25 26.7zm-50-101.5h-66v-67.6h66v67.6zm-51.4-14.7h37v-38.2h-37v38.2zM333.8 231h-66.4v-67.5h66.4V231zM282 216.5h37v-38.2h-37v38.2z"/>
                </svg></div>
                  <div class="formBx">
                    {{-- <form method="POST"> --}}
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        {{-- action="{{ route('login') }}"  --}}
                      @csrf
        
                      <h2>Sign In</h2>
                      {{-- <input type="text" name="" placeholder="Username" /> --}}
        
                      <input type="email" id="login-email" class="form-control @error('email') is-invalid @enderror"
                      placeholder="Email Address" name="email" value="{{ old('email') }}"/>
        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
        
        
                      {{-- <input type="password" name="" placeholder="Password" /> --}}
                      <input type="password" id="login-password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password"/>
        
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
        
                      {{-- <input type="submit" name="" formaction="{{ __('Login') }}" value="{{ __('Login') }}" /> --}}
                      <button type="submit" class="btn btn-danger w-50">
                        {{ __('Login') }}
                      </button> &nbsp;
        
                      <p class="signup">
                        Don't have an account ?
                        <a href="" id="signup-btn" onclick="toggleForm(event)">Sign Up!</a>
                        {{-- <button class="btn" onclick="toggleForm()">Sign Up!</button> --}}
                      </p>
                    </form>
                  </div>
                </div>
        
                {{-- SIGN UP --}}
                <div class="user signupBx">
                  <div class="formBx">
                    {{-- <form id="signupForm" method="POST"> --}}
                    <form method="POST" action="{{ route('register') }}" id="signup-btn">
                      @csrf
        
                      <h2>Create an account</h2>
                      {{-- <input type="text" name="" placeholder="Username" /> --}}
                      <input type="text" placeholder="Name" id="form2Example10" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                      placeholder="Full Name" />
                      @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
        
                      {{-- <input type="email" name="" placeholder="Email Address" /> --}}
                      <input type="email" placeholder="Email Address" id="signup-email" class="form-control @error('email_signup') is-invalid @enderror" name="email_signup" value="{{ old('email_signup') }}"
                      placeholder="Email address" />
                      @error('email_signup')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
        
                      {{-- DESCRIPTION --}}
                      {{-- <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="A short write-up about yourself...">{{ old('description') }}</textarea>
        
                      @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror --}}
        
        
        
                      {{-- <input type="password" name="" placeholder="Create Password" /> --}}
                      <input type="password" placeholder="Create Password" id="signup-password" class="form-control @error('passwordSignup') is-invalid @enderror" name="passwordSignup" />
        
                      @error('passwordSignup')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
        
                      {{-- <input type="password" name="" placeholder="Confirm Password" /> --}}
                      <input type="password" placeholder="Confirm Password" id="form2Example23" class="form-control @error('passwordSignup_confirmation') is-invalid @enderror"  name="passwordSignup_confirmation"/>
        
                      @error('passwordSignup_confirmation')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
        
                      {{-- <input type="submit" formaction="{{ __('Sign Up') }}" name="" value="{{ __('Sign Up') }}" /> --}}
                      {{-- <input type="submit" name="" value="{{ __('Sign Up') }}" /> --}}
                      <button type="submit" class="btn btn-danger w-50">
                        {{ __('Sign Up') }}
                      </button> &nbsp;
        
                      <p class="signup">
                        Already have an account ?
                        <a href="" id="login-btn" onclick="toggleForm(event)">Sign In!</a>
                        {{-- <button class="btn" onclick="toggleForm()">Sign In!</button> --}}
                      </p>
                    </form>
                  </div>
                  <div class="imgBx d-flex">
        
                    {{-- BANANA SVG --}}
                    <!-- Generator: Adobe Illustrator 21.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="svg-banana" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 612 792" style="enable-background:new 0 0 612 792;" xml:space="preserve">
        
                    <g>
                      <style type="text/css">
                        .st0{fill:none;stroke:#FDD44B;stroke-miterlimit:10; stroke-width:10;}
                    </style>
                        <path class="st0" d="M514.3,258.8c-4.1-31.9-17.7-62.6-10.7-95.8c1.3-6.1-2.8-9-8.9-9c-7.6,0.1-15.2,0-22.9,0
                            c-15.4,0-17,1.3-17.6,16.7c-0.4,10.3,0,20.5,0,30.8c0,7.3,0.6,14.6-1,21.8c-17.8,79.7-46.7,154.6-98.2,218.9
                            c-67.1,83.7-153.7,131.9-261.7,139c-6.7,0.4-9.9,3.1-9.9,9.5c0,6.9,0.9,13.9,0.6,20.8c-0.2,6.6,2.9,9.7,8.9,10.9
                            c40.5,8.5,81.3,14.9,126.7,14.5c19.5,0.3,42.5-1.6,65.3-6.1c65.3-12.8,121.4-41.9,162.3-95.3C510.4,453.5,527.4,359.4,514.3,258.8z
                             M427.6,534.2c-37.4,45.5-88.1,69.9-145.4,80.8c-43.5,8.3-87,7.7-130.5,0.8c-35.9-4.8-35.4-19.2-35.9-19.5
                            c140.9-21,239.1-99.6,302.9-224.3c23.2-45.3,39-93.3,50-142.9c3.7-16.7,1.2-33.7,1.3-50.5c0-7,2.2-8.8,9.1-8.9
                            c8-0.2,7.6,4.1,7.1,9.4c-1.9,21.8,4.6,42.5,8.5,63.6C514.2,349.3,497.9,448.5,427.6,534.2z"/>
                    </g>
                    <g>
                        <g>
                            <path class="st0" d="M245,579.4c-20.6,8-42.2,13-64.3,14.8c-4.6,0.4-8,4.4-7.7,9c0.4,4.6,4.4,8,9,7.7c23.7-1.9,46.9-7.3,69-15.9
                                c2.7-1.1,4.6-3.4,5.1-6c0.3-1.6,0.2-3.2-0.4-4.8C254.1,579.8,249.3,577.7,245,579.4z"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path class="st0" d="M392.8,483.7c-7.7,10.2-16.3,19.9-25.6,28.7c-19.1,18.1-40.9,32.6-64.7,43.1c-4.2,1.9-6.1,6.8-4.3,11
                                c1.9,4.2,6.8,6.1,11,4.3c25.6-11.3,49-26.9,69.5-46.3c10-9.5,19.3-19.9,27.5-30.8c0.6-0.8,1.1-1.7,1.3-2.7c1-3.3-0.1-6.9-3-9.1
                                C400.9,479.2,395.6,480,392.8,483.7z"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path class="st0" d="M469.7,339.4c-4.6-0.6-8.8,2.7-9.3,7.3c-3.9,32-14.3,62.2-30.9,89.6c-2.4,4-1.1,9.1,2.9,11.5
                                c4,2.4,9.1,1.1,11.5-2.9c8.9-14.7,16.1-30.2,21.6-46.2c5.5-16.1,9.4-32.8,11.5-50C477.6,344.2,474.3,340,469.7,339.4z"/>
                        </g>
                    </g>
                    </svg>
                    {{-- BANANA END --}}
        
        
        
                  </div>
                </div>
              </div>
            </section>
    </div>
    
        <script>
            function toggleForm(e) {
    
                if (e.target.id == 'login-btn') {
                    var login_form = document.getElementById('login-form');
                    // login_form.addEventListener("submit", function() {
                    //     return false;
                    // })
                    e.preventDefault()
                }
    
                if (e.target.id == 'signup-btn') {
                    var signup_form = document.getElementById('signup-form');
                    // signup_form.addEventListener("submit", function() {
                    //     return false;
                    // })
                    e.preventDefault()
                }
    
                const container = document.getElementById('login-container');
                container.classList.toggle('active');
    
                const path_monkey = document.getElementById('path-monkey');
                path_monkey.classList.toggle('monkey');
    
                const path_banana = document.getElementById('svg-banana');
                path_banana.classList.toggle('banana');
            };
    
    
            // const form = document.querySelector("form");
            // const classes = form.classList;
            // var x = "";
            // var y = "";
            // if (classList.contains(`onsubmit="return false`)){
            //     x = `onsubmit="return false`;
            //     y = `
            // }
            // else{
    
            // }
    
            // const amendForm = classes.replace(`onsubmit="return false`, `onsubmit={{ __('Login') }}`)
    
            // function addActive() {
            //     const container = document.getElementById('login-container');
            //     container.classList.add('active');
            // }
    
            // function removeActive() {
            //     const container = document.getElementById('login-container');
            //     container.classList.remove('active');
            // }
    
        </script>
    </div>

  </body>

@endsection

