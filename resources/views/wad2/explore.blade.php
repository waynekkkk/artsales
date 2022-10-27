@extends('layouts.app')

@section('content')
<body>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<style>
        .heart {
        cursor: pointer;
        height: 50px;
        width: 50px;
        background-image:url( 'https://abs.twimg.com/a/1446542199/img/t1/web_heart_animation.png');
        background-position: left;
        background-repeat:no-repeat;
        background-size:2900%;
        }

        .heart:hover {
        background-position:right;
        }

        .is_animating {
        animation: heart-burst .8s steps(28) 1;
        }

        @keyframes heart-burst {
        from {background-position:left;}
        to { background-position:right;}
        }
      
        .card_wrapper{
            width: 25rem;
            border-radius: 15px;
        }

        .img_wrapper{
            border-top-left-radius: 13px;
            border-top-right-radius: 13px;
        }

        .grids {
        display: grid;
        /* margin:150px; */
        gap: 5%;
        justify-content: center;
        }

        /* Screen larger than 768 2 column */
        @media (min-width: 860px) {
        .grids { 
            grid-template-columns: repeat(2, 1fr); 
            }
        }

        /* Screen larger than 960 3 columns */
        @media (min-width: 1330px) {
        .grids { grid-template-columns: repeat(3, 1fr); }
        }
        /* Screen larger than 1200  columns */
        @media (min-width: 1800px) {
        .grids { grid-template-columns: repeat(4, 1fr); 
        }
        }
    </style>
</head>

<body>
    <div class="text-center pt-5">
        <h1>Explore incredible art</h1>
    </div>
    <div class="container d-flex justify-content-center pt-3 position-static">
        <button type="button" class="btn btn-dark rounded-pill me-3" onclick="shuffle()">Shuffle Artwork
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shuffle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.624 9.624 0 0 0 7.556 8a9.624 9.624 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.595 10.595 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.624 9.624 0 0 0 6.444 8a9.624 9.624 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5z"/>
            <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192zm0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192z"/>
        </svg>
        </button>
    </div>
    

  <!-- Keep modals for artworks -->
    <div id="artworks_modal"></div>

    <!--card-->
    <div class="container" style='margin-bottom:175px; margin-top:30px;'>
    <!-- display artworks -->
        <div class="grids" id="artworks">
           <h1>not working</h1>
        </div>
    </div>

<!-- do not delete this commented part, it does not work without this -->
<!-- <div class="grids">
    @foreach($all_artworks_by_votes as $artwork)
    <div class="card card_wrapper">
        <img style="cursor: pointer; object-fit:cover; width:100%; height:400px;" data-bs-toggle="modal" data-bs-target="{{$artwork->id}}Modal" class="card-img-top img_wrapper" src="{{$artwork->asset->asset_url}}" alt="Card image cap">
        <div class="card-body">
            <h3 class="card-title">{{$artwork->title}}</h3>
            <div class="d-flex justify-content-end">
                <div class="heart"></div>
            </div>
        </div>
    </div> 
    @endforeach
</div> -->

    <script>
        var works = {{ Illuminate\Support\Js::from($all_artworks_by_votes) }};

        // slice to random 3 works
        three_works = works.slice(0,3)

        // shuffle array of artworks
        function shuffleWork(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // display artworks
        function showAll(array){
            let artworks = ""
            let artwork_modal = ""
            array.forEach(artwork => {
                artworks += `
                <div class="card card_wrapper">
                <img style="cursor: pointer; object-fit:cover; width:100%; height:400px;" data-bs-toggle="modal" data-bs-target="#Modal${artwork.id}" class="card-img-top img_wrapper" src="${artwork.asset.asset_url}" alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title">${artwork.title}</h3>
                    <div class="d-flex justify-content-end">
                        <div class="heart"></div>
                    </div>
                </div>
            </div> `
            artwork_modal += `
            <div class="modal fade" id="Modal${artwork.id}">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel${artwork.id}">${artwork.title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <img src="${artwork.asset.asset_url}" style="width: 100%;">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill me-3" data-bs-dismiss="modal">Nope</button>
                    <button type="button" class="btn btn-dark rounded-pill">Love it!</button>
                    </div>
                </div>
                </div>
            </div>
            `
        });
        document.getElementById("artworks_modal").innerHTML = artwork_modal
        document.getElementById("artworks").innerHTML = artworks
        }

        shuffleWork(works)
        showAll(three_works)

        function shuffle(){
            shuffleWork(works)
            three_works = works.slice(0,3)
            showAll(three_works)
        }
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script>
        // allow poopover
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        
        /* when a user clicks, toggle the 'is-animating' class */
        $(".heart").on('click touchstart', function(){
            $(this).toggleClass('is_animating');
        });
        
        /*when the animation is over, remove the class*/
        $(".heart").on('animationend', function(){
            $(this).toggleClass('is_animating');
        });
    </script>    
</body>
@endsection