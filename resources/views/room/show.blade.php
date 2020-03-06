@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-between">
        <table>
            <thead>
            <tr>
                <td>Player</td>
                <td>Specialty</td>
                <td>Actions</td>
                @if($room->owner_id === auth()->user()->id)
                    <td>
                        Admin actions
                    </td>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($players as $player)
                <tr>
                    <td>{{ $player->username }}</td>
                    <td>
                        @if($player->player_role)
                            {{ $player->player_role }}
                        @elseif($player->user_id === auth()->user()->id)
                            <a class="btn btn-primary" href="{{ route('game.role', $player->id) }}">set role</a>
                        @endif
                    </td>
                    <td>
                        @if($player->user_id === auth()->user()->id)
                            <a class="btn btn-primary" href="{{ route('game.index', $player->id) }}">game sheet</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('game.check', $player->id) }}">check player</a>
                        @endif
                    </td>
                    @if($room->owner_id === auth()->user()->id && $player->user_id !== auth()->user()->id)
                        <td>
                            <a class="btn btn-primary"
                               href="{{ route('room.setAdmin', ['room' => $room->id, 'user' => $player->user_id]) }}">Make
                                admin</a>
                            <a class="btn btn-danger"
                               href="{{ route('room.kick', ['room' => $room->id, 'user' => $player->user_id]) }}">kick
                                player</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <a class="btn btn-secondary" href="{{ route('room.edit', $room->id) }}">Room settings</a>
        </div>
    </div>
@endsection
