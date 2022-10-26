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
                        <div class="card rounded-3" style="background-color: #f8fafc;min-height: 70vh;">
                        <div class="row g-0" style="min-height: 70vh;">
                            <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">                
                                    <div class="card artwork-card" style="min-height: 70vh; min-width:40vh;">
                                        <img src="https://images.unsplash.com/photo-1552596828-4e48cd784320?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1160&q=80" class="card-img-top" style="min-width: 40vh; min-height: 40vh;">
                                        <div class="card-body">
                                            <h5 class="card-title">Title</h5>
                                            <p class="card-text">Description</p>
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
                                    <input id="artwork-title" class="form-control form-control-md form-control-solid @error('title') is-invalid @enderror" type="text" name='title' placeholder="Enter the title of your artwork here!">
                    
                                    @error('title')
                                        <span class="invalid-feedback text-start" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <br>
                                    <label class="form-label fs-6 fw-bolder text-dark float-start">Description</label>
                                    <input id="artwork-des" class="form-control form-control-md form-control-solid @error('description') is-invalid @enderror" type="text" name='description' placeholder="Enter the description of your artwork here!">
                    
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

                <script>

                </script>
            </section>
            
        </div>
        
    </div>

@endsection