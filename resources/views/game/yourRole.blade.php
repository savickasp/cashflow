@extends('layouts.app')

@section('content')
    <div class="container">
        <div><span>Your Role is {{ $role }}</span></div>
        <a href="{{ route('room.show', $room) }}" class="btn btn-primary">Get back to room</a>
    </div>
@endsection
