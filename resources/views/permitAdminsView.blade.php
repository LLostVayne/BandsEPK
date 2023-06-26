@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Select admins to have permission edit the band: <b>{{ $name }}</b></h2>
        <form action="{{ route('handlePermitAdmins', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @foreach ($users as $user)
                @if (Auth::user()->name != $user->name && $adminRoles->contains('model_id', $user->id))
                    <div class="form-check">
                        @if (in_array($user->id, $managed_by))
                            <input type="checkbox" class="form-check-input" id="checkbox" name="values[]" value="{{ $user->id }}" checked>
                        @else
                            <input type="checkbox" class="form-check-input" id="checkbox" name="values[]" value="{{ $user->id }}">
                        @endif
                        <label for="{{ $user->name }}" class="form-check-label">{{ $user->name }}</label>
                    </div>
                @endif
            @endforeach
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
