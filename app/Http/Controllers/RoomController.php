<?php

namespace App\Http\Controllers;

use App\Game;
use App\Room;
use App\Rules\InviteCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $room = DB::table('games')
            ->join('rooms', 'games.room_id', '=', 'rooms.id')
            ->join('users', 'rooms.owner_id', '=', 'users.id')
            ->select('games.room_id', 'rooms.owner_id', 'users.username', 'rooms.name', 'rooms.created_at')
            ->where('games.user_id', '=', auth()->user()->id)
            ->get();

        return view('room.index', ['rooms' => $room]);
    }

    public function create()
    {
        return view('room.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:rooms|max:255'
        ]);

        $room = new Room();
        $room->owner_id = auth()->user()->id;
        $room->name = $validated['name'];
        $room->invite_code = Str::random(8);

        $room->save();

        $room->user()->attach(auth()->user()->id);

        return redirect(route('room.index'));
    }

    public function show(Room $room)
    {
        // validate if user can access this room
        if ($this->hasAccess(auth()->user()->id, $room->id)) {

            $players = DB::table('games')
                ->where('games.room_id', '=', $room->id)
                ->join('users', 'games.user_id', '=', 'users.id')
                ->select('games.id', 'users.username', 'games.user_id', 'games.player_role')
                ->get();

            return view('room.show', ['room' => $room, 'players' => $players]);
        } else {

            return view('room.joinFirst', ['room' => $room]);
        }
    }

    public function edit(Room $room)
    {
        // validates if user has access to room
        if ($this->hasAccess(auth()->user()->id, $room->id)) {

            // validates if user is room admin
            if ($this->canEdit(auth()->user()->id, $room->id)) {

                return view('room.edit', ['room' => $room]);
            } else {

                return view('room.notOwner', ['room' => $room]);
            }

        } else {

            return view('room.joinFirst', ['room' => $room]);
        }
    }

    public function update(Request $request, Room $room)
    {
        return redirect();
    }

    public function destroy(Room $room)
    {
        if ($this->hasAccess(auth()->user()->id, $room->id)) {

            if ($this->canEdit(auth()->user()->id, $room->id)) {
                return view('room.destroy', ['room' => $room, 'string' => Str::random(8)]);
            } else {
                return view('room.notOwner', ['room' => $room]);
            }
        } else {
            return view('room.joinFirst', ['room' => $room]);
        }
    }

    public function destroySave(Request $request, Room $room)
    {
        $validated = $request->validate([
            'string_confirm' => 'required|max:8|min:8|same:string',
        ]);
            $room->user()->detach();
            $room->delete();
            return redirect(route('room.index'));
    }

    public function join(Room $room)
    {
        return view('room.join');
    }

    public function joinValidate(Request $request, Room $room)
    {
        $validated = $request->validate([
            'invite_code' => ['required', 'max:255', new InviteCode($room->id)]
        ]);

        $room->user()->attach(auth()->user()->id);

        return redirect(route('room.show', $room->id));

    }

    public function kickPlayer(Room $room, User $user)
    {
        if ($this->hasAccess(auth()->user()->id, $room->id)) {

            if ($this->canEdit(auth()->user()->id, $room->id)) {
                return view('room.kick', ['string' => Str::random(8), 'user' => $user]);
            } else {
                return view('room.notOwner', ['room' => $room]);
            }
        } else {
            return view('room.joinFirst', ['room' => $room]);
        }

    }

    public function kickPlayerSave(Request $request, Room $room, User $user)
    {
        $validated = $request->validate([
            'string_confirm' => 'required|max:8|min:8|same:string',
        ]);
        $room->user()->detach($user->id);
        return redirect(route('room.show', $room->id));
    }

    public function setAdmin(Room $room, User $user)
    {
        if ($this->hasAccess(auth()->user()->id, $room->id)) {

            if ($this->canEdit(auth()->user()->id, $room->id)) {
                return view('room.setAdmin', ['string' => Str::random(8), 'room' => $room, 'user' => $user]);
            } else {
                return view('room.notOwner', ['room' => $room]);
            }
        } else {
            return view('room.joinFirst', ['room' => $room]);
        }

    }

    public function setAdminSave(Request $request, Room $room, User $user)
    {
        $validated = $request->validate([
            'string_confirm' => 'required|max:8|min:8|same:string',
        ]);

        $room->update(['owner_id' => $user->id]);

        return redirect(route('room.show', $room->id));
    }

    private function hasAccess(int $userId, int $roomId)
    {
        $game = DB::table('games')
            ->where('user_id', '=', $userId)
            ->where('room_id', '=', $roomId)
            ->first();

        if ($game === null) return false;
        return true;
    }

    private function canEdit(int $userId, int $roomId)
    {
        $game = DB::table('rooms')
            ->where('owner_id', '=', $userId)
            ->where('id', '=', $roomId)
            ->first();

        if ($game === null) return false;
        return true;
    }
}
