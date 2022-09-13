@extends('layouts.app')

@section('content')

<script>
    var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };

</script>

<body>

    
    
    <div class="container">
        
        <h1 class="my-4 text-center fst-italic fw-bold">Automobiles</h1>
        <hr>

            @php
            $counter = 0;
            @endphp

                @foreach ($tasks as $task)

                    @if ($counter % 2 == 0)
                        <div class="row justify-content-center row-cols-1 row-cols-lg-2 g-5 p-3">                        
                    @endif

                        <div class="col col-md-6 justify-content-center">
                            
                            <div class="card border-1 h-100">

                                <div class="card-header text-center" style="font-size: 1.2em">
                                    {{ $task->description }}
                                </div>

                                @if ($task->img_path)
                                    <img src="{{ asset('images/' . $task->img_path) }}" alt="" class="card-img-top card-img-top-square-edges">
                                @endif

                                <div class="card-body">

                                    <div class="card-title fw-bold">
                                        Done by: {{ $task->user_id }}
                                    </div>

                                    <div class="card-text">
                                        <p>
                                            Description: {{ $task->description }}                                        
                                        </p>
                                    </div>
                                    
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a href="view/{{ $task->id }}" class="btn btn-outline-primary btn-block">View &rarr;</a>
                                        <a href="tasks/{{ $task->id }}/edit" class="btn btn-outline-primary btn-block">Edit &rarr;</a>
                                        <a href="delete/{{ $task->id }}" class="btn btn-outline-primary btn-block">Delete &rarr;</a>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                        
                    @if ($counter % 2 != 0)
                        </div>
                    @endif

                    @php
                        $counter++;
                    @endphp

                @endforeach
        
                
    </div>
    
    
</body>


@endsection
    