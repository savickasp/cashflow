<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Game $game)
    {

    }

    public function setRole(Game $game)
    {
        return view('game.role', ['roles' => config()->get('playerroles.roleNames')]);
    }

    public function saveRole(Request $request, Game $game)
    {
        return redirect(route('room.show', ['room' => $game->room_id]));
    }
}
