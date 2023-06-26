@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('handleCreateBandForm') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>Add new band</h2>
            <div class="form-group">
                <label for="bandName" class="form-label">Band name:</label>
                <input type="text" class="form-control" name="bandName" placeholder="Band name">
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Descritipn:</label>
                <textarea type="text" class="form-control" name="description" placeholder="Band description" rows="1"></textarea>
            </div>
            <div class="form-group">
                <label for="biography" class="form-label">Biography:</label>
                <textarea type="text" class="form-control" name="biography"  placeholder="Band biography" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="youtubeLink" class="form-label">Youtube links:</label>
                <input type="url" class="form-control" name="youtubeLink" placeholder="https://www.youtube.com/v=" required>
            </div>
            <div class="form-group">
                <label for="bandPicture" class="form-label">Band picture:</label>
                <input type="file" class="form-control" name="bandPicture">
            </div>
            <div class="form-group">
                <label for="textColor" class="form-label">Text Color:</label>
                <input type="color" class="form-control form-control-color" name="text_color">
            </div>
            <div class="form-group">
                <label for="backgroundColor" class="form-label">Background Color:</label>
                <input type="color" class="form-control form-control-color" name="background_color">
            </div>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
            </div>
        </form>
    </div>
@endsection
