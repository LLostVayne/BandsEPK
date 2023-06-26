@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Welcome, {{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <h2>Managed Bands:</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th style="padding-right:20px">ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Biography</th>
                <th class="text-nowrap" style="padding-right:20px">Youtube Links</th>
                <th class="text-nowrap" style="padding-right:20px">Text Color</th>
                <th class="text-nowrap" style="padding-right:20px">Background Color</th>
                <th>Band Logo</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($bands as $band)
                <tr>
                    <td class="text-wrap">{{ $band->id }}</td>
                    <td class="text-nowrap">{{ $band->name }}</td>
                    <td class="text-wrap">
                        <div style="height:100px; overflow:auto;">
                            {{ $band->description }}
                        </div>
                    </td>
                    <td class="text-wrap">
                        <div style="height:100px; overflow:auto;">
                            {{ $band->biography }}
                        </div>
                    </td>
                    <td class="text-nowrap">{{ $band->youtube_link }}</td>
                    <td style="background-color:{{ $band->text_color }}"></td>
                    <td style="background-color:{{ $band->background_color }}"></td>
                    <td class="text-nowrap"><img src="{{ Storage::url('Images/' . $band->image) }}" style="width:100px;height:100px" alt="Band Logo"></td>
                    <td class="p-4">
                        <a href="{{ route('editBand', ['id' => $band->id]) }}" class="btn btn-primary">Edit</a>
                    </td>
                    <td class="p-4">
                        <form action="{{ route('deleteBand', ['id' => $band->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this band?')">Delete</button>
                        </form>
                    </td>
                    <td class="p-4">
                        <a href="{{route('permitAdminsView',['band' => $band->name , 'id' => $band->id,'managed_by' => $band->managed_by])}}" class="btn btn-warning">Permit</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <form action="{{ route('createBandForm') }}"method="GET">
            <input type="submit" class="btn btn-primary" value="Add new band" />
        </form>
    </div>
@endsection
