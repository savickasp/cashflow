@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            <thead>
            <tr>
                <td>Room name</td>
                <td>Owner</td>
                <td>Created at</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
            <tr>
                <td><a href="{{ route('room.show', $room->room_id) }}">{{ $room->name }}</a></td>
                <td><a href="{{ route('user.profile', $room->owner_id) }}">{{ $room->username }}</a></td>
                <td>{{ $room->created_at }}</td>
                <td>
                    <a class="btn btn-success"
                        href="{{ route('room.show', $room->room_id) }}">enter</a>
                    @if($room->owner_id === auth()->user()->id)
                    <a class="btn btn-dark"
                    href="{{ route('room.edit', $room->owner_id) }}">settings</a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
