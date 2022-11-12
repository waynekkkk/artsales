@extends('layouts.app')

@section('content')
<body>

    <div class="text-center my-4">
        <h1 class="mb-2">Discover All Artworks!</h1>
        <p style="font-size: 16px" class="fw-light">Browse through the entire State Of The Art Collection</p>
    </div>
    
    <script>
        var countId = 0;
    </script>

    <div class="px-5 m-4 row row-cols-1 row-cols-md-3 g-4">
        @foreach ($all_artworks as $artwork)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <!-- Modal -->
                <div class="modal fade" id="artwork-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">{{ $artwork->title }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $artwork->asset->asset_url }}" class="card-img-top">
                                <hr>
                                <p class="fw-semibold">{{ $artwork->description }}</p>
                                <div class="d-flex justify-content-between">
                                    <div class="vote text-muted">
                                        <small>Votes: {{ $artwork->votes }}</small>
                                    </div>
                                    @if (Auth::check() && !($artwork->artist_id == Auth::user()->id))
                                        <div class="stage">
                                            <div class="heart" 
                                                @if (Auth::check() && !($artwork->artist_id == Auth::user()->id))
                                                    onclick="postLike(event, {{ $artwork->id }}, {{ Auth::user()->id }})"
                                                @elseif (Auth::check() && ($artwork->artist_id == Auth::user()->id))
                                                    onclick="alert('Oh dear! We know you love your own art, but let\'s be fair!')"
                                                @else
                                                    onclick="alert('Please log in to start casting your votes!')"
                                                @endif>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    artworkModal = document.getElementById('artwork-modal').id;
                    artworkModal += countId;
                    document.getElementById('artwork-modal').id = artworkModal;
                </script>

                <div class="card h-100 artwork-card" style="width: 400px">
                    <img style="cursor: pointer; border-radius:15px 15px 0 0;" id="artist-artwork" src="{{ $artwork->asset->asset_url }}" class="card-img-top" data-bs-target="#artwork-modal" data-bs-toggle="modal">
                    <div class="card-body">
                        <h5 class="card-title">{{ $artwork->title }}</h5>
                        <p class="card-text">
                            <span class="fw-semibold d-block">By: <a href="{{ route('user.account', $artwork->artist_id) }}"><u>{{$artwork->artist->name}}</u></a></span>
                            <span class="fw-light">{{ $artwork->description }}</span>
                        </p>
                        <div class="text-end">
                            <button type="button" id="targetArt" class="btn btn-white text-end" data-bs-toggle="modal" data-bs-target="#artwork-modal">
                                •••
                            </button>
                        </div>
                        
                    </div>
                    <div class="card-footer p-4">
                        <div class="d-flex justify-content-between">
                            <div class="vote text-muted">
                                <small>Votes: {{ $artwork->votes }}</small>
                            </div>
                            @if (Auth::check() && !($artwork->artist_id == Auth::user()->id))
                                <div class="stage">
                                    <div class="heart" 
                                        @if (Auth::check() && !($artwork->artist_id == Auth::user()->id))
                                            onclick="postLike(event, {{ $artwork->id }}, {{ Auth::user()->id }})"
                                        @elseif (Auth::check() && ($artwork->artist_id == Auth::user()->id))
                                            onclick="alert('Oh dear! We know you love your own art, but let\'s be fair!')"
                                        @else
                                            onclick="alert('Please log in to start casting your votes!')"
                                        @endif>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                        
                        <script>
                            targetModal = document.getElementById('targetArt').id;
                            artworkId = document.getElementById('artist-artwork').id;
                            artworkId += countId;
                            targetModal += countId;
                            document.getElementById('targetArt').id = targetModal;
                            document.getElementById('artist-artwork').id = artworkId;
                            targetModalImg = document.getElementById(artworkId).dataset.bsTarget;
                            targetModalBtn = document.getElementById(targetModal).dataset.bsTarget;
                            targetModalImg += countId;
                            targetModalBtn += countId;
                            document.getElementById(artworkId).dataset.bsTarget = targetModalImg;
                            document.getElementById(targetModal).dataset.bsTarget = targetModalBtn;
                            countId++;
                        </script>
                    </div>
                </div>
            </div>
       @endforeach
    
    </div>

    <div class="d-flex justify-content-center mt-2 mb-5">
        {!! $all_artworks->links() !!}
    </div>

</body>
@endsection