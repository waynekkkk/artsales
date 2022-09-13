@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row justify-content-center text-center">
            <h1>Delete Vehicle</h1>
                <form action="/delete2" method="get" class="form-group custom-form-width col-lg-6">
                    @csrf
                    
                        <input class="form-control" type="text" placeholder="ID..." name='id'>

                    <br>

                    <button class="btn btn-outline-success btn-block" type="submit">
                        Submit
                    </button>
                    
                </form>
            
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-lg-6 w-25">

                     @foreach ($errors->all() as $messages)
        
                        <li>
                            {{ $messages }}
                        </li>
                    
                    @endforeach
               
            </div>
        </div>
        
    </div>

@endsection