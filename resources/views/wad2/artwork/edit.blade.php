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
            <h1>Gotta edit your artwork!</h1>

            <form action="{{ route('user.update_edit_artwork', ['user_id'=>Auth::user()->id, 'artwork_id'=>$artwork->id]) }}" method="post" enctype="multipart/form-data" class="form-group col-lg-6">
                @csrf
                <label class="form-label fs-6 fw-bolder text-dark float-start">Title</label>
                <input class="form-control form-control-md form-control-solid @error('title') is-invalid @enderror" type="text" name='title' value="{{ $artwork->title }}">

                @error('title')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <label class="form-label fs-6 fw-bolder text-dark float-start">Description</label>
                <input class="form-control form-control-md form-control-solid @error('description') is-invalid @enderror" type="text" name='description' value="{{ $artwork->description }}">

                @error('desription')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>

                <button class="btn btn-outline-success btn-block w-100" type="submit">
                    EDIT MY ARTWORK!!!
                </button>
            </form>
        </div>
        
    </div>

@endsection