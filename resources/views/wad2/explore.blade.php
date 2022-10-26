@extends('layouts.app')

@section('content')
<body>
<h1>hi</h1>
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
            /* margin-left: 20px; */
            margin-bottom: 50px;
        }

        .img_wrapper{
            border-top-left-radius: 13px;
            border-top-right-radius: 13px;
        }

        .grids {
        display: grid;
        margin-top: 30px;
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
<div class="container d-flex justify-content-end pt-3 position-static">
    <button type="button" class="btn btn-light rounded-pill me-3 sticky-top" onclick="shuffle()">Random Artwork</button>
    <!-- <button type="button" class="btn btn-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#artistModal">Random Artist</button> -->
    
   <!-- Button trigger modal -->

  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="artworkModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="artworkModalLabel">{{ $artworks[0]->title }} to be updated by vue</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <img src="https://image.kpopmap.com/2020/12/blackpink-elle-jisoo-1.jpg" style="width: 100%;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light rounded-pill me-3" data-bs-dismiss="modal">Nope</button>
          <button type="button" class="btn btn-dark rounded-pill">Love it!</button>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="artistModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="artworkModalLabel">{{ $artworks[0]->title }} to be updated by vue</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <img src="https://image.kpopmap.com/2020/12/blackpink-elle-jisoo-1.jpg" style="width: 100%;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light rounded-pill me-3" data-bs-dismiss="modal">Nope</button>
          <button type="button" class="btn btn-dark rounded-pill">Love it!</button>
        </div>
      </div>
    </div>
</div>

    <div id="artworks_modal"></div>
    <!--card-->
    <div class="container">
        <div class="grids" id="artworks">
            <a tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus"  data-bs-content="add image here">
                <div class="card card_wrapper ">
                    <img style="width: 200px;" class="card-img-top img_wrapper" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="card-title">Titus Low</h3>
                        <p class="card-text">I am going to jail. please show some support for my ice cream shop</p>
                        <div class="d-flex justify-content-end">
                            <div class="heart"></div>
                        </div>
                    </div>
                </div> 
            </a>

            <div class="card card_wrapper">
                <img style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#artistModal" class="card-img-top img_wrapper" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_21ZgcYYoO9HR-eNc_kIDEsO2hXUh1FKbhg&usqp=CAU" alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title">Titus Low</h3>
                    <p class="card-text">I am going to jail. please show some support for my ice cream shop</p>
                    <div class="d-flex justify-content-end">
                        <div class="heart"></div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    
    <script>
        let works = [
            {name:"jisoo", link:"https://wwd.com/wp-content/uploads/2022/09/jisoo-2.jpg?w=1024"},
            {name:"rose", link:"https://fashionista.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cfl_progressive%2Cq_auto:good%2Cw_1200/MTkyNjM1OTcxMjk0OTk2MTU0/rose-blackpink-at-saint-laurent-spring-2023-show-paris.jpg"},
            {name:"jennie", link:"https://www.chanel.com/images/q_auto,f_auto,fl_lossy,dpr_auto/w_1344/FSH-CHN-1632472742663-coconeigevisuallogo1080x108001.jpg"},
            {name:"lisa", link:"https://media.vogue.co.uk/photos/5f69b3d49590f66bc1d7084a/16:9/w_1600%2Cc_limit/GettyImages-1151690198%2520(1).jpg"},

        ]
        

        function shuffleWork(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
        shuffleWork(works)
        function showAll(array){
            let artworks = ""
            let artwork_modal = ""
            array.forEach(person => {
                artworks += `
                <div class="card card_wrapper">
                <img style="cursor: pointer; object-fit:cover; width:100%; height:400px;" data-bs-toggle="modal" data-bs-target="#${person.name}Modal" class="card-img-top img_wrapper" src="${person.link}" alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title">${person.name}</h3>
                    <div class="d-flex justify-content-end">
                        <div class="heart"></div>
                    </div>
                </div>
            </div> `
            artwork_modal += `
            <div class="modal fade" id="${person.name}Modal">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="${person.name}ModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <img src="${person.link}" style="width: 100%;">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill me-3" data-bs-dismiss="modal">Nope</button>
                    <button type="button" class="btn btn-dark rounded-pill">Love it!</button>
                    </div>
                </div>
                </div>
            </div>
            `
            document.getElementById("artworks_modal").innerHTML = artwork_modal
            });
            document.getElementById("artworks").innerHTML = artworks
        }
        showAll(works)

        function shuffle(){
            shuffleWork(works)
            showAll(works)
        }
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- make heart work -->
    <!-- <script src="./discover.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
        
    </script>    
</body>
@endsection