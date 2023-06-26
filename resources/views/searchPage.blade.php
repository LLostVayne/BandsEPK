@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="post" action="{{ route('searchResults') }}">
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="searchBand">Search band</label>
                <input type="text" placeholder="Band name" name="searchBand" class="form-control">
            </div>
            <button style="margin-top:20px" type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="container mt-5">
        @if (count($bands) > 0)
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-6">Name</th>
                    <th class="col-md-6">Band Picture</th>
                </tr>
                @foreach ($bands as $band)
                    <tr>
                        <td class="align-middle">
                            <a class="link-primary" href="{{ url('/band/' . $band['id']) }}"> {{ $band['name'] }}</a>
                        </td>
                        <td>
                            <img src="{{ Storage::url('Images/' . $band['image']) }}" style="height:100px">
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

@endsection
