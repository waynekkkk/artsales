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

    <body>
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                        
                                        <div class="text-center">
                    
                                            <!-- BRAND LOGO GOES HERE -->
                                            <img src="{{ asset('images/logo.png') }}" style="width: 150px;" alt="logo">
                                            <h5 class="mt-1 mt-5 pb-1">Signup</h5>
                                        </div>
                        
                                        <form action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example11">Name</label>
                                                <input type="text" id="form2Example10" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                                placeholder="Full Name" />

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example11">Email</label>
                                                <input type="email" id="form2Example11" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                                placeholder="Email address" />

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                            
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example22">Password</label>
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

                                            <div class="form-outline mb-4">
                                                <label for="is_artist" class="form-label">{{ __('Are you an artist?') }}</label>
                
                                                <select name="is_artist" id="is_artist" class="form-select form-select-md form-select-solid" required>
                                                    <option value='' disabled selected>Select One</option>
                                                    <option value='yes'>Yes</option>
                                                    <option value='no'>No</option>
                                                </select>

                                            </div>
                            
                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button type="submit" class="btn btn-danger">
                                                    {{ __('Sign Up') }}
                                                </button>                                                
                                            </div>
                            
                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <p class="mb-0 me-2">Have an existing account? &nbsp; </p>
                                                <button type="button" onclick="window.location.href='{{ route('about_us') }}';" class="btn btn-outline-danger">Log in</button>
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
            
        
        </body>

@endsection
