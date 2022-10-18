@extends('layouts.app')

@section('content')
{{-- 
    <div class="container-fluid vh-100 bg-overlay" style="color: #fff">

        <div class="container">
            <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8 justify-content-center">
            
                <h1 class="login-header">Login</h1>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end" style="font-family: SingaporeSling
                        ">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror placeholder-font" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Please enter your email address">
        
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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror placeholder-font" name="password" required autocomplete="current-password" placeholder="Please enter your password" style="">
        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
        
                    <div class="row mb-3 offset-md-4">
                        <div class="col-md-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                <label class="form-check-label" for="remember" style="font-family: SingaporeSling">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
        
                    <div class="row mb-0 offset-md-4">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary" style="font-family: SingaporeSling">
                                {{ __('Login') }}
                            </button>
        
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="font-family: SingaporeSling">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                
            </div>

        </div>
        </div>
        
    </div>
</body> --}}

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
                        <h5 class="mt-1 mt-5 pb-1">Login</h5>
    
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example11">Email</label>
                                <input type="email" id="form2Example11" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email address" name="email" value="{{ old('email') }}"/>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form2Example22">Password</label>
                                <input type="password" id="form2Example22" class="form-control @error('password') is-invalid @enderror" name="password"/>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                            <div class="text-center pt-1 mb-5 pb-1">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Login') }}
                                </button> &nbsp;
                                <a class="text-muted" href="#!">  Forgot password?</a>
                            </div>
            
                            <div class="d-flex align-items-center justify-content-center pb-4">
                                <p class="mb-0 me-2">New here? &nbsp; </p>
                                <button type="button" onclick="window.location.href='{{ route('register') }}';" class="btn btn-outline-danger">Sign Up</button>
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

