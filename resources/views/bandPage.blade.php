@extends('layouts.app')
@section('content')
    <div class="container" style="background-color:{{ $band->background_color }}; color:{{ $band->text_color }}; font-family: Monaco;">
        <h1 class="text-center">{{ $band->name }}</h1>
        <div class="row">
            <div class="col-md-10">
                <p class="text-center">{{ $band->description }}</p>
            </div>
            <div class="col-md-1">
                <img src="{{ Storage::url('Images/' . $band->image) }}" style="width:100%" alt="Band Image">
            </div>
            <div>
                <h3>Bio</h3>
                <p>{{ $band->biography }}</p>
            </div>
        </div>
        <div class="embed-responsive embed-responsive-4by3">
            <iframe class="embed-responsive-item" width="425" height="350" src="{{ $band->youtube_link }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
        <a class="btn btn-dark" href="{{ url('/search')}}">Search bands</a>
        @if (in_array(Auth::id(), json_decode($band->managed_by))) 
            <a class="btn btn-dark" href="{{route('editBand',['id' => $band->id])}}">Edit band</a>
        @endif
    </div>
@endsection
