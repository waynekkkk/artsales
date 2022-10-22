@extends('layouts.app')

@section('content')
    <div class="container p-5">
            <!-- Validation Errors -->
            @if ($errors->any())
                
            <div class="row justify-content-center text-center col-lg-6 offset-lg-3">
                <div class="alert alert-danger text-center">                      
                    There seems to be some incomplete required fields!
                </div> 
            </div>

            @endif

        <div class="row justify-content-center text-center">
            <h1>Update Particulars</h1>

            <form action="{{ route('user.update_particulars', $user->id) }}" method="post" enctype="multipart/form-data" class="form-group col-lg-6">
                @csrf
                <label class="form-label fs-6 fw-bolder text-dark float-start">Name</label>
                <input class="form-control form-control-md form-control-solid @error('name') is-invalid @enderror" type="text" name='name' value="{{ $user->name }}">

                @error('name')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <label class="form-label fs-6 fw-bolder text-dark float-start">Email</label>
                <input class="form-control form-control-md form-control-solid @error('email') is-invalid @enderror" type="email" name='email' value="{{ $user->email }}">

                @error('email')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <label class="form-label fs-6 fw-bolder text-dark float-start">Description</label>
                <input class="form-control form-control-md form-control-solid @error('description') is-invalid @enderror" type="text" name='description' value="{{ $user->description }}">

                @error('description')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <label class="form-label fs-6 fw-bolder text-dark float-start">Upload Your Profile Picture</label>
                <input class="form-control form-control-md form-control-solid @error('profile_picture') is-invalid @enderror" type="file" name='profile_picture'>

                @error('profile_picture')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <label class="form-label fs-6 fw-bolder text-dark float-start">Upload Your Banner</label>
                <input class="form-control form-control-md form-control-solid @error('banner') is-invalid @enderror" type="file" name='banner'>

                @error('banner')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <button class="btn btn-outline-success btn-block w-100" type="submit">
                    Submit
                </button>
            </form>
        </div>
        
    </div>

@endsection