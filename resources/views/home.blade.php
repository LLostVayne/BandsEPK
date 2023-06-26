@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to the Bands EPK Website</h1>
        <p>This website showcases electronic press kits (EPKs) for various bands.</p>
        <p>Explore the bands, their music, and learn more about them.</p>
        @if (count($bands) >= 3)
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ Storage::url('Images/' . $bands[0]->image) }}"
                            alt="{{ $bands[0]->name . 'Image' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bands[0]->name }}</h5>
                            <p class="card-text">{{ $bands[0]->description }}</p>
                            <a class="btn btn-primary" href="{{ url('/band/' . $bands[0]->id) }}">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ Storage::url('Images/' . $bands[1]->image) }}"
                            alt="{{ $bands[1]->name . 'Image' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bands[1]->name }}</h5>
                            <p class="card-text">{{ $bands[1]->description }}</p>
                            <a class="btn btn-primary" href="{{ url('/band/' . $bands[1]->id) }}">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ Storage::url('Images/' . $bands[2]->image) }}"
                            alt="{{ $bands[2]->name . 'Image' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bands[2]->name }}</h5>
                            <p class="card-text">{{ $bands[2]->description }}</p>
                            <a class="btn btn-primary" href="{{ url('/band/' . $bands[2]->id) }}">Learn more</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @endsection
