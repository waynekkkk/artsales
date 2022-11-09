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

        <div class="row justify-content-center">
            <h1 class="text-center">Add more amazing artwork!</h1>

            <section class="h-100 gradient-form">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3" style="background-color: #f8fafc;">
                        <div class="row g-0" style="">
                            <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">                


                                    <div class="card artwork-card" style="border-radius: 15px; filter: drop-shadow(0.35rem 0.35rem 0.4rem rgba(0, 0, 0, 0.5))">
                                        <img id="artwork-preview" style="border-radius: 15px 15px 0 0 ;" src="https://images.unsplash.com/photo-1552596828-4e48cd784320?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1160&q=80" class="card-img-top " style="border-radius: 15px 15px 0 0;">

                                        <div class="card-body">
                                            <h5 id="artwork-title-preview" class="card-title">Title</h5>
                                            <p id="artwork-description-preview" class="card-text">Description</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <small class="text-muted">Votes: </small>
                                                <!-- FIGURE OUT HOW TO DO IT WITHOUT INLINE STYLR -->
                                                <small class="text-muted"><span style="margin-left:5px;">Votes will come once you upload!</span></small>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center ">
                            <div class="mx-auto">
                                <form action="{{ route('user.update_artwork_add', $user_id) }}" method="post" enctype="multipart/form-data" class="form-group col-lg-12">
                                    @csrf
                                    <label class="form-label fs-6 fw-bolder text-dark float-start">Title</label>
                                    <input id="artwork-title" class="form-control form-control-md form-control-solid @error('title') is-invalid @enderror" type="text" name='title' placeholder="Enter the title of your artwork here!" oninput="previewTitle(event)">
                    
                                    @error('title')
                                        <span class="invalid-feedback text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <br>
                                    <label class="form-label fs-6 fw-bolder text-dark float-start">Description</label>
                                    <input id="artwork-description" class="form-control form-control-md form-control-solid @error('description') is-invalid @enderror" type="text" name='description' placeholder="Enter the description of your artwork here!" oninput="previewDesc(event)">
                    
                                    @error('description')
                                        <span class="invalid-feedback text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <br>
                                    <label class="form-label fs-6 fw-bolder text-dark float-start">Upload Your Artwork!</label>
                                    <input id="artwork-img" class="form-control form-control-md form-control-solid @error('artwork') is-invalid @enderror" type="file" name='artwork'>
                    
                                    @error('artwork')
                                        <span class="invalid-feedback text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <br>
                    
                                    <button class="btn btn-outline-success btn-block w-100 mb-4" style="width: 350px;" type="submit">
                                        ADD MY ARTWORK!!!
                                    </button>
                                </form>

                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            </section>
            
        </div>
        
    </div>

    <script>

        function previewTitle(e) {
            document.getElementById('artwork-title-preview').innerText = e.target.value;
            if (e.target.value == null || e.target.value == "") {
                document.getElementById('artwork-title-preview').innerText = 'Title';
            }
        }

        function previewDesc(e) {
            document.getElementById('artwork-description-preview').innerText = e.target.value;
            if (e.target.value == null || e.target.value == "") {
                document.getElementById('artwork-description-preview').innerText = 'Description';
            }
        }

        const img = document.getElementById("artwork-img");
        const imagePreview = document.getElementById("artwork-preview");
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

    </script>

@endsection