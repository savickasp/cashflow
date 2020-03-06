@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-between">
        <div class="d-flex flex-column">
            <h4>Room join info</h4>
            <span>To join a room you need to send this link:</span>
            <span>{{ route('room.join', $room->id) }}</span>
            <span>End the invite code to confirm join:</span>
            <span>{{ $room->invite_code }}</span>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('room.show', $room->id) }}">Room</a>
        </div>
    </div>
    <div class="container mt-5">
        <h3>Delete room</h3>
        <a class="btn btn-danger" href="{{ route('room.destroy', $room->id) }}">Delete room</a>
    </div>
@endsection
