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


            <section class="h-100 gradient-form">
                <div class="border">
                    <div class="row d-flex justify-content-center h-100 w-100 mx-auto">
                    <div class="col-xl-10">
                        <div class="rounded-3" style="background-color: #f8fafc;">
                        <div class="row g-0" style="">
                            <div class="col-lg-6">           
                                <div class="my-5 mx-0 mx-sm-5">
                                    <div id="map" class="border border-dark"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                                <form action="{{ route('user.update_event_add', $user_id) }}" method="post" enctype="multipart/form-data" class="form-group mt-0 mt-sm-5 mb-5" style="">
                                    @csrf
                                    <label class="form-label fs-6 fw-bolder text-dark float-start">Select an event to join here!</label>
                                    <select name="museum_id" id='selectedMuseum' class="form-select form-select-md form-select-solid @error('museum_id') is-invalid @enderror">
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
                        </div>
                    </div>
                    </div>
                </div>
            </section>

            <script>
                var museum_collection = {{ Illuminate\Support\Js::from($museums_w_id) }};   
                // zoom into chosen museum upon selection
                function initMap() {
                    // Creating map with a view of Singapore
                    var map = new google.maps.Map(
                    document.getElementById('map'), {zoom: 12, center: {lat: 1.3521, lng: 103.8198}});

                    var marker = new google.maps.Marker({
                        postion: {lat: 1.3521, lng: 103.8198},
                        map: map,
                        icon:{
                            url:"https://cdn-icons-png.flaticon.com/512/4874/4874738.png",
                            scaledSize: new google.maps.Size(40,40)
                        }
                    })

                    let markers = [];

                    function setMapOnAll(map){
                        for (let i = 0; i < markers.length; i++) {
                            markers[i].setMap(map);
                        }
                    }
                    function hideMarkers() {
                        setMapOnAll(null);
                    }

                    document.getElementById('selectedMuseum').addEventListener('change', () => {
                        var selectedMuseumId = document.getElementById('selectedMuseum').value;
                        marker.setMap(null);

                        Object.keys(museum_collection).forEach(id => {
                            if (selectedMuseumId == id){
                                const newLatLng = {lat: parseFloat(museum_collection[id].lat), lng: parseFloat(museum_collection[id].long)};
                                
                                var marker = new google.maps.Marker({
                                    postion: newLatLng,
                                    map: map,
                                    icon:{
                                        url:"https://cdn-icons-png.flaticon.com/512/4874/4874738.png",
                                        scaledSize: new google.maps.Size(40,40)
                                    }
                                })
                                hideMarkers();
                                markers.push(marker);
                                marker.setPosition(newLatLng);
                                window.setTimeout(() => {
                                    map.setZoom(16);
                                    map.panTo(newLatLng);
                                }, 800);
                                    }
                                })

                    });

                    // map.addListener("center_changed", () => {
                    //     // 3 seconds after the center of the map has changed, pan back to the
                    //     // marker.
                    //     map.setZoom(16);
                    //     window.setTimeout(() => {
                    //     map.panTo(new google.maps.LatLng(newLat, newLng));
                    //     }, 3000);
                    // });
                }
            </script>
            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMZU_4S6OOzBbyFvBbiU8Kkwq3-fxhwJI&callback=initMap"></script>
        </div>
        
    </div>

@endsection