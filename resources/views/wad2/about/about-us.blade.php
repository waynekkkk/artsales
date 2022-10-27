@extends('layouts.app')

@section('content')
<body>

    <!--BACKGROUND IMAGE FOR HEADER GOES HERE-->
    {{-- <div class="container text-center my-2">
        <div class="row">
            <div class="col-lg-3 col-md-6 monkey-frame">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                    <path class="monkey" fill="#fff" stroke="red" d="M331 439.6H167.5L111 329.4v-50.2L61 227V112h56l133-51.6L380.5 112H439v115l-52.6 55.8v46.6L331 439.6zM179.3 425H319v-38H179.4v38zm-53.5-99l39 75.8V278L138 225.7V168l58.3-57.6 53 26.4 52.5-26.4L361 168v57.8L333.8 278v123.3l38-75.4V124L250 76.2l-124.2 48V326zm53.5 46.3H319v-90.7L249 258l-69.5 23.5v90.8zm69.5-129.8l74 24.8 23.6-45v-48l-47.3-46-49.5 25-50-25L153 174v48.4l23 45 73-24.7zm137.6-115.8v134.7l38-40.3v-94h-38zM75.6 221l35.5 37V126.7H76V221zm142.8 111.8l-25.8-26.6L203 296l26 26.5-10.6 10.3zm62.7 0l-10.4-10.2 25-26.6 10.7 10-25 26.7zm-50-101.5h-66v-67.6h66v67.6zm-51.4-14.7h37v-38.2h-37v38.2zM333.8 231h-66.4v-67.5h66.4V231zM282 216.5h37v-38.2h-37v38.2z"/>
                </svg>
            </div>
            <div class="col-lg-3 col-md-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                    <path class="monkey" fill="#fff" stroke="red" d="M331 439.6H167.5L111 329.4v-50.2L61 227V112h56l133-51.6L380.5 112H439v115l-52.6 55.8v46.6L331 439.6zM179.3 425H319v-38H179.4v38zm-53.5-99l39 75.8V278L138 225.7V168l58.3-57.6 53 26.4 52.5-26.4L361 168v57.8L333.8 278v123.3l38-75.4V124L250 76.2l-124.2 48V326zm53.5 46.3H319v-90.7L249 258l-69.5 23.5v90.8zm69.5-129.8l74 24.8 23.6-45v-48l-47.3-46-49.5 25-50-25L153 174v48.4l23 45 73-24.7zm137.6-115.8v134.7l38-40.3v-94h-38zM75.6 221l35.5 37V126.7H76V221zm142.8 111.8l-25.8-26.6L203 296l26 26.5-10.6 10.3zm62.7 0l-10.4-10.2 25-26.6 10.7 10-25 26.7zm-50-101.5h-66v-67.6h66v67.6zm-51.4-14.7h37v-38.2h-37v38.2zM333.8 231h-66.4v-67.5h66.4V231zM282 216.5h37v-38.2h-37v38.2z"/>
                </svg>
            </div>
            <div class="col-lg-3 col-md-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                    <path class="monkey" fill="#fff" stroke="red" d="M331 439.6H167.5L111 329.4v-50.2L61 227V112h56l133-51.6L380.5 112H439v115l-52.6 55.8v46.6L331 439.6zM179.3 425H319v-38H179.4v38zm-53.5-99l39 75.8V278L138 225.7V168l58.3-57.6 53 26.4 52.5-26.4L361 168v57.8L333.8 278v123.3l38-75.4V124L250 76.2l-124.2 48V326zm53.5 46.3H319v-90.7L249 258l-69.5 23.5v90.8zm69.5-129.8l74 24.8 23.6-45v-48l-47.3-46-49.5 25-50-25L153 174v48.4l23 45 73-24.7zm137.6-115.8v134.7l38-40.3v-94h-38zM75.6 221l35.5 37V126.7H76V221zm142.8 111.8l-25.8-26.6L203 296l26 26.5-10.6 10.3zm62.7 0l-10.4-10.2 25-26.6 10.7 10-25 26.7zm-50-101.5h-66v-67.6h66v67.6zm-51.4-14.7h37v-38.2h-37v38.2zM333.8 231h-66.4v-67.5h66.4V231zM282 216.5h37v-38.2h-37v38.2z"/>
                </svg>
            </div>
            <div class="col-lg-3 col-md-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                    <path class="monkey" fill="#fff" stroke="red" d="M331 439.6H167.5L111 329.4v-50.2L61 227V112h56l133-51.6L380.5 112H439v115l-52.6 55.8v46.6L331 439.6zM179.3 425H319v-38H179.4v38zm-53.5-99l39 75.8V278L138 225.7V168l58.3-57.6 53 26.4 52.5-26.4L361 168v57.8L333.8 278v123.3l38-75.4V124L250 76.2l-124.2 48V326zm53.5 46.3H319v-90.7L249 258l-69.5 23.5v90.8zm69.5-129.8l74 24.8 23.6-45v-48l-47.3-46-49.5 25-50-25L153 174v48.4l23 45 73-24.7zm137.6-115.8v134.7l38-40.3v-94h-38zM75.6 221l35.5 37V126.7H76V221zm142.8 111.8l-25.8-26.6L203 296l26 26.5-10.6 10.3zm62.7 0l-10.4-10.2 25-26.6 10.7 10-25 26.7zm-50-101.5h-66v-67.6h66v67.6zm-51.4-14.7h37v-38.2h-37v38.2zM333.8 231h-66.4v-67.5h66.4V231zM282 216.5h37v-38.2h-37v38.2z"/>
                </svg>
            </div>
        </div>
    </div>

        <div class="container mb-5 text-center">
            <div class="display-4">
                About us
            </div>
            <div>
                State of the Art was founded by a <u>group of four monkeys</u> as part of their coding project. They were unified by one common purpose - to bring art to everyone, everywhere, beyond the frames. <br>
            </div>    
        </div> --}}

        <div class="outer">
            

            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-10">
                    <div class="card rounded-3" style="background-color: #f8fafc;">
                    <div class="row g-0">
                        <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">

                            {{-- <div class="sota-animate">
                                <h1 class="text-center">
                                    State of The Art
                                </h1> --}}
                                {{-- <h1 class="text-center">
                                    State of The Art
                                </h1> --}}

                            {{-- </div> --}}
                            
            
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
                                    <path class="monkey" fill="#f8fafc" stroke="red" d="M331 439.6H167.5L111 329.4v-50.2L61 227V112h56l133-51.6L380.5 112H439v115l-52.6 55.8v46.6L331 439.6zM179.3 425H319v-38H179.4v38zm-53.5-99l39 75.8V278L138 225.7V168l58.3-57.6 53 26.4 52.5-26.4L361 168v57.8L333.8 278v123.3l38-75.4V124L250 76.2l-124.2 48V326zm53.5 46.3H319v-90.7L249 258l-69.5 23.5v90.8zm69.5-129.8l74 24.8 23.6-45v-48l-47.3-46-49.5 25-50-25L153 174v48.4l23 45 73-24.7zm137.6-115.8v134.7l38-40.3v-94h-38zM75.6 221l35.5 37V126.7H76V221zm142.8 111.8l-25.8-26.6L203 296l26 26.5-10.6 10.3zm62.7 0l-10.4-10.2 25-26.6 10.7 10-25 26.7zm-50-101.5h-66v-67.6h66v67.6zm-51.4-14.7h37v-38.2h-37v38.2zM333.8 231h-66.4v-67.5h66.4V231zM282 216.5h37v-38.2h-37v38.2z"/>
                                </svg>
                            </div>
            
                        </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center" style="background-color: white">
                        <div class="px-3 py-4 p-md-5 mx-md-4">
                            <h2>About Us</h2>
                            <h5 class="mb-4">We believe in art beyond the frames</h5>
                            <p class="small mb-0 fs-6">State of the Art was founded by a <span id="four-monkey"> group of four monkeys </span> as part of their coding project. They were unified by one common purpose - to bring art to everyone, everywhere, beyond the frames.</p>
                            <br>
                            <br>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

</body>
@endsection