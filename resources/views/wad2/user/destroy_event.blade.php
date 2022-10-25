@extends('layouts.app')

@section('content')
    <div class="container p-5 min-vh-65">
            <!-- Validation Errors -->
            @if ($errors->any())
                
            <div class="row justify-content-center text-center col-lg-6 offset-lg-3">
                <div class="alert alert-danger text-center">                      
                    There seems to be some incomplete required fields!
                </div> 
            </div>

            @endif

        <div class="row justify-content-center text-center">
            <h1 class="mb-3">It was a good one. Now, we have to say goodbye.</h1>

            <form action="{{ route('user.update_destroy_event', $user_id) }}" method="post" enctype="multipart/form-data" class="form-group col-lg-6">
                @csrf
                <label class="form-label fs-6 fw-bolder text-dark float-start">Event</label>
                <select name="event_id" class="form-select form-select-md form-select-solid @error('event_id') is-invalid @enderror">
                    <option selected disabled>Please select the event you want to leave</option>

                    @foreach ($events as $event)
                        <option value={{ $event->id }} {{ old('event_id') == $event->id ? 'selected' : '' }}>{{ $event->museum->name . ', ' . $event->datetime_start . ' - ' . $event->datetime_end }}</option>
                    @endforeach

                </select>

                @error('event_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <button class="btn btn-outline-success btn-block w-100" type="submit">
                    Till we meet again fam...
                </button>
            </form>
        </div>
        
    </div>

@endsection