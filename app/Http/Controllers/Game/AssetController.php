<?php

namespace App\Http\Controllers\Game;

use App\Asset;
use App\Game;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    public function roleSetup(int $roleId, int $gameId)
    {
        $roleData = config()->get('playerroles.roleFull.' . $roleId);

        $asset = Asset::firstOrCreate([
            'game_id' => $gameId,
            'name' => 'salary',
        ]);

        $asset->type = 0;
        $asset->cash_flow = $roleData['salary'];
        $asset->save();
    }

    public function getAll(User $user, Game $game)
    {
        if ($game->user_id === $user->id) {
            $assets = DB::table('assets')
                ->where('game_id', '=', $game->id)
                ->get();

            return response($assets, 200);
        } else {
            return response(403);
        }
    }
}
