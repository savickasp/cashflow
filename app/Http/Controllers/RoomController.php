<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $room = DB::table('room_user')
            ->join('rooms', 'room_user.room_id', '=', 'rooms.id')
            ->join('users', 'rooms.owner_id', '=', 'users.id')
            ->select('room_user.room_id', 'rooms.owner_id', 'users.username', 'rooms.name', 'rooms.created_at')
            ->where('room_user.user_id', '=', auth()->user()->id)
            ->get();

        return view('room.index', ['rooms' => $room]);
    }

    public function create()
    {
        return view('room.create', []);
    }

    public function store(Request $request)
    {
        return redirect();
    }

    public function show(Room $room)
    {
        return view('room.show', []);
    }

    public function edit(Room $room)
    {
        return view('room.edit', []);
    }

    public function update(Request $request, Room $room)
    {
        return redirect();
    }

    public function destroy(Room $room)
    {
        return view('room.destroy', []);
    }

    public function destroySave()
    {
        return redirect();
    }
}
