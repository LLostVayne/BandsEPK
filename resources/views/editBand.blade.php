@extends('layouts.app')
@section('content')
    @if (!in_array(Auth::id(), json_decode($band->managed_by)))
        <div class="container">
            <h1>401 Unauthorized</h1>
            <p>You are not authorized to access this page.</p>
        </div>
    @else
        <div class="container">
            <form method="post" action="{{ route('handleEditBandForm', ['id' => $band->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2>Edit Band</h2>
                <div class="form-group">
                    <label for="bandName" class="form-label">Band name:</label>
                    <input type="text" class="form-control" value="{{ $band->name }}" name="bandName">
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Descritipn:</label>
                    <textarea class="form-control" name="description" rows="1">{{ $band->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="biography" class="form-label">Biography:</label>
                    <textarea class="form-control" name="biography" rows="4">{{ $band->biography }}</textarea>
                </div>
                <div class="form-group">
                    <label for="youtubeLink" class="form-label">Youtube link:</label>
                    <input type="url" class="form-control" value="{{ $band->youtube_link }}" name="youtubeLink">
                </div>
                <div class="form-group">
                    <label for="bandPicture" class="form-label">Band picture:</label>
                    <input type="file" class="form-control" name="bandPicture">
                    @if ($band->image)
                        <p>Current image: <img src="{{ Storage::url('Images/' . $band->image) }}"
                                style="width:5%;height:5%;margin-top:10px" alt="Band Image"></p>
                    @else
                        <p>No image available</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="textColor" class="form-label">Text Color:</label>
                    <input type="color" class="form-control form-control-color" value="{{ $band->text_color }}"
                        name="text_color">
                </div>
                <div class="form-group">
                    <label for="backgroundColor" class="form-label">Background Color:</label>
                    <input type="color" class="form-control form-control-color" value="{{ $band->background_color }}"
                        name="background_color">
                </div>
                <div class="form-group" style="margin-top:10px">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                </div>
            </form>
        </div>
    @endif
@endsection
