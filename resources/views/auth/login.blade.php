<body class="login-page-scroll">
@extends('layouts.app')

@section('content')

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
</body>

@endsection



{{-- <div class="card card-disable-hover">
    <div class="card-header">{{ __('Login') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div> --}}
