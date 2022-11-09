@extends('layouts.app')

@section('content')
    <div id="artist-profile">
        <!-- Dynamic displaying of background img. See mini lab 2 and how they do it -->

        <!-- To make it dynamic and customisable to user -->
        <img id="banner-image" src="{{ $banner ? $banner->asset_url : asset('images/hero.jpeg') }}" alt="Banner Image">
        
    </div>

    <div class="container">

        <div class="display-pic text-center mb-3">
            <!-- Dynamic displaying of dp. Similar to profileBackground --> 
            <!-- Nav bar too.  -->
            <img id="profile-image" src="{{ $profile_picture ? $profile_picture->asset_url : asset('images/hello_kitty.jpeg') }}" alt="Profile Image">
            <div class="profile-image-animation"></div>
        </div>
        
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

            <form action="{{ route('user.update_particulars', $user->id) }}" method="post" enctype="multipart/form-data" class="form-group col-lg-6 my-4">
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
                <input class="form-control form-control-md form-control-solid @error('profile_picture') is-invalid @enderror" type="file" name='profile_picture' id='profile_picture'>

                @error('profile_picture')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <label class="form-label fs-6 fw-bolder text-dark float-start">Upload Your Banner</label>
                <input class="form-control form-control-md form-control-solid @error('banner') is-invalid @enderror" type="file" name='banner' id="banner">

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

    <script>
        const img = document.getElementById("profile_picture");
        const imagePreview = document.getElementById("profile-image");
        img.addEventListener("change", (e) => {
            const imgDetails = document.querySelector("input[type=file]").files[0];
            if (imgDetails) {
                previewImage(imgDetails);
            } else {
                imagePreview.src = ""
                console.error("Please select a picture");
            }

        })

        function previewImage(imgD) {
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                imagePreview.src = reader.result;
            })

            if (imgD) {

                if (imgD.type === "image/jpeg" || imgD.type == "image/jpg" || imgD.type == "image/gif" || imgD.type == "image/png") {
                    reader.readAsDataURL(imgD);
                } else {
                    imagePreview.src = "";
                }
            }
        }

        const img_banner = document.getElementById("banner");
        const imagePreviewBanner = document.getElementById("banner-image");
        img_banner.addEventListener("change", (e) => {
            const imgDetails = document.getElementById('banner').files[0];
            if (imgDetails) {
                previewImageBanner(imgDetails);
            } else {
                imagePreviewBanner.src = ""
                console.error("Please select a picture");
            }

        })

        function previewImageBanner(imgD) {
            const reader_banner = new FileReader();

            reader_banner.addEventListener("load", function () {
                imagePreviewBanner.src = reader_banner.result;
            })

            if (imgD) {

                if (imgD.type === "image/jpeg" || imgD.type == "image/jpg" || imgD.type == "image/gif" || imgD.type == "image/png") {
                    reader_banner.readAsDataURL(imgD);
                } else {
                    imagePreviewBanner.src = "";
                }
            }
        }
    </script>

@endsection