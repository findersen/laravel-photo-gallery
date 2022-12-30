@extends('layouts.app')

@section('title', 'Galleries List')

@section('content')

    <section class="text-center mt-5 mb-5">
        <div class="container">
            <h1 class="jumbotron-heading">{{ $gallery->title }}</h1>
            <p class="lead text-muted">{{ $gallery->description }}</p>
        </div>
    </section>

    <div id="carousel" class="carousel slide mb-5" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
            @php $first = true; @endphp

            @foreach($gallery->photos as $k => $photo)
                <li data-target="#carousel"
                    data-slide-to="{{ $k }}" {{ $first ? 'class="active"' : ''}}></li>
                @php $first = false; @endphp
            @endforeach
        </ol>
        <div class="carousel-inner">
            @php $first = true; @endphp

            @foreach($gallery->photos as $photo)
                <div class="carousel-item {{ $first ? 'active' : ''}}">
                    <img class="d-block w-100" src="{{ asset('storage/'. $photo->filename) }}" alt=""
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                </div>
                @php $first = false; @endphp
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>

@endsection