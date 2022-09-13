@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row justify-content-center text-center">
            <h1>UPDATE TASK</h1>
            <form action="/update/{{ $task->id }}" method="post" enctype="multipart/form-data" class="form-group w-25 col-lg-6">
                @csrf

                <input class="form-control" type="text" name='description' value="{{ $task->description }}">
                <br>
                <input class="form-control" type="number" min=0 name='user_id' value="{{ $task->user_id }}">
                <br>
                <input class="form-control" type="file" name='img'>
                <br>
                <button class="btn btn-outline-success btn-block" type="submit">
                    Submit
                </button>
            </form>
        </div>
        
        <div class="row justify-content-center text-center">
            <div class="col-lg-6 w-25">
                @foreach ($errors->all() as $message)
                    <li>
                        {{ $message }}
                    </li>
                @endforeach
            </div>
        </div>
        
        
    </div>

@endsection