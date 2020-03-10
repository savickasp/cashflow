<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Controllers\Game\AssetController;
use App\Http\Controllers\Game\LiabilityController;
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
        if ($game->user_id === auth()->user()->id) {
            $user = [
                'id' => auth()->user()->id,
                'name' => auth()->user()->id,
                'api_token' => auth()->user()->api_token,
                'game_id' => $game->id
            ];

            return view('game.index', ['user' => $user]);
        }
    }

    public function setRole(Game $game)
    {
        if ($game->player_role === null) {
            return view('game.role', ['roles' => config()->get('playerroles.roleNames')]);
        }else {
            return view('game.yourRole', [
                'room' => $game->room_id,
                'role' => config()->get('playerroles.roleNames.' . $game->plyer_role)
            ]);
        }
    }

    public function saveRole(Request $request, Game $game)
    {
        $validated = $request->validate([
            'role' => [
                'required',
                'numeric',
                'min:0',
                'max:11',
            ],
        ]);

        $asset = new AssetController();
        $asset->roleSetup($validated['role'], $game->id);

        $liability = new LiabilityController($game->id);
        $liability->roleSetup($validated['role']);

        DB::table('games')
            ->where('id', '=', $game->id)
            ->update(['player_role' => $validated['role']]);

        return view('game.yourRole', [
            'room' => $game->room_id,
            'role' => config()->get('playerroles.roleNames.' . $validated['role'])
        ]);
    }
}
