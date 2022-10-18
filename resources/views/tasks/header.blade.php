{{-- <div class="container-fluid bg-overlay text-center shadow" style="height: 500px" id="top">
    <body>
        <div class="row justify-content-center align-items-center" style="height: 500px">
            <div class="col-5 typewriter px-4">
                <h1 style="font-size: 60px" id="top" class="font-italic">Finest Automobiles</h1>
            </div>
            
        </div>
    </body>
</div> --}}
<div class="container-fluid px-0">
    <div id="carousel-ferrari" class="carousel slide shadow-lg" data-bs-ride="carousel" data-bs-interval="false" data-bs-pause="false">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carousel-ferrari" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carousel-ferrari" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carousel-ferrari" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner h-100">

          <div class="carousel-item active bg-overlay align-items-center">
            <div class="carousel-caption font-italic">
                <div class="typewriter" style="font-family: SingaporeSling">
                    <h1>Finest Automobiles.</h1>
                </div>
                
            </div>
          </div>

          <div class="carousel-item img-overlay">
            <img src="{{ asset("images/Mclaren.jpeg") }}" class="d-block w-100" alt="..." style="opacity: 0.6">
          </div>

          <div class="carousel-item img-overlay">
            <img src="{{ asset("images/Ferrari-F8.jpeg") }}" class="d-block w-100" alt="..." style="opacity: 0.6">
          </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-ferrari" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carousel-ferrari" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        
    </div>
</div>
