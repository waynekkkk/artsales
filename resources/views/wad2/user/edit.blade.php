@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row justify-content-center text-center">
            <h1>Update Particulars</h1>
            <form action="{{ route('update_particulars', $user->id) }}" method="post" enctype="multipart/form-data" class="form-group w-25 col-lg-6">
                @csrf

                <input class="form-control" type="text" name='name' value="{{ $user->name }}">
                <br>
                <input class="form-control" type="email" name='email' value="{{ $user->email }}">
                <br>
                <input class="form-control" type="file" name='profile_picture'>
                <br>
                <button class="btn btn-outline-success btn-block" type="submit">
                    Submit
                </button>
            </form>
        </div>
        
        <div class="row justify-content-center text-center my-3">
            <div class="col-lg-6 w-25 text-danger">
                @foreach ($errors->all() as $message)
                    <li>
                        {{ $message }}
                    </li>
                @endforeach
            </div>
        </div>
        
        
    </div>

@endsection