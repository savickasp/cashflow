<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $userId;

    public function __construct()
    {
        $this->middleware('auth');
        $this->userId = auth()->user()->id;
    }

    public function index()
    {
        return view('room.index', []);
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
