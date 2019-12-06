@extends('master')

@section('content')

    <div class="container">
        <h1 class="title">{{ $entry->title }}</h1>
        <h4 class="text-muted">{{ $entry->uid }}</h4>


        <div class="row">
            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Content: </h3>
                        {{ $entry->content }}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Additional Notes: </h3>
                        {{ $entry->additional_notes }}
                    </div>
                </div>
            </div>
        </div>

        @if($entry->getMedia()->count() > 0)
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Attached Images: </h3>
                        
                        @foreach($entry->getMedia() as $media)
                            <a href="{{ $media->getUrl() }}" data-lightbox="{{ $entry->title }}">
                                <img src="{{ $media->getUrl() }}" alt="" class="lightbox-gallery-img shadow mr-3">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12 mt-3 text-center">
                <div class="card">
                    <div class="card-body">
                        <a href="" class="btn btn-info">Edit</a>
                        <a href="" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop