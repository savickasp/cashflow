@extends('layouts.app')

@section('content')
    <div class="container">
        <span>Your not in this room. Join first to access room content. Ask room owner for code. Then click button bellow</span>
        <a class="btn btn-success" href="{{ route('room.join', $room->id) }}">Join room</a>
    </div>
@endsection
