
@extends('layouts.app')

@section('content')
    <div  class="container-fluid p-5">
        <div class="row justify-content-center text-center">
            <h1>Add New Vehicle</h1>
                <form action="/task" method="post" enctype="multipart/form-data" class="form-group custom-form-width">
                    @csrf

                    <input type="text" class="form-control" name='description' placeholder="Enter description">
                    <br>
                    <input type="number" class="form-control" min=0 name='user_id' placeholder="Enter User ID">
                    <br>
                    <input type="file" class="form-control" name='img'>
                    <br>
                    <button type="submit" class="btn btn-outline-skobeloff btn-block">
                        Submit
                    </button>
                </form>

                @foreach ($errors->all() as $message)
                    <li>
                        {{ $message }}
                    </li>
                @endforeach
        </div>
                

    </div>
@endsection