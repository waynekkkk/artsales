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

            @if (session()->has('invalid_date'))
                
                <div class="row justify-content-center text-center col-lg-6 offset-lg-3">
                    <div class="alert alert-danger text-center">                      
                        {{ session('invalid_date') }}
                    </div> 
                </div>

            @endif

        <div class="row justify-content-center text-center">
            <h1 class="mb-4">Let's join another wonderful event!</h1>

            <form action="{{ route('user.update_event_add', $user_id) }}" method="post" enctype="multipart/form-data" class="form-group col-lg-6">
                @csrf
                <label class="form-label fs-6 fw-bolder text-dark float-start">Select an event to join here!</label>
                <select name="museum_id" class="form-select form-select-md form-select-solid @error('museum_id') is-invalid @enderror">
                    <option selected disabled>Please select a museum to join the event!!</option>

                    @foreach ($museums as $museum)
                        <option value={{ $museum->id }} {{ old('museum_id') == $museum->id ? 'selected' : '' }}>{{ $museum->name }}</option>
                    @endforeach

                </select>

                @error('museum_id')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <br>

                <!--begin::Label-->
                <label class="form-label fs-6 fw-bolder text-dark float-start">When do you intend to join this event?</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control-md form-control-solid @error('datetime_start') is-invalid @enderror" type="datetime-local" name="datetime_start" autocomplete="off" value={{ old('datetime_start') }}>
                
                @error('datetime_start')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <!--end::Input-->
                <!--begin::Label-->
                <label class="form-label fs-6 fw-bolder text-dark float-start">When will this event end for you?</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control-md form-control-solid @error('datetime_end') is-invalid @enderror" type="datetime-local" name="datetime_end" autocomplete="off" value={{ old('datetime_end') }}>
                
                @error('datetime_end')
                    <span class="invalid-feedback text-start" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br>
                <!--end::Input-->

                <button class="btn btn-outline-success btn-block w-100" type="submit">
                    ADD ME TO THE EVENT!!!
                </button>
            </form>
        </div>
        
    </div>

@endsection