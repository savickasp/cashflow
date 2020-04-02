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

    public function addAsset(User $user, Game $game, Request $request)
    {
        if ($game->id === $request['game_id'] && $game->user_id === $user->id) {

            $data = $request->validate([
                'name' => 'string|required',
                'quantity' => 'numeric|required',
                'price' => 'numeric|required',
                'game_id' => 'numeric|required',
                'type' => 'numeric|required',
                'cash_flow' => 'numeric|nullable'
            ]);

            $assets = Asset::insertGetId($data);
            return response('updated');
        } else {
            return response(null, 401);
        }
    }

    public function sellAsset(User $user, Game $game, Request $request)
    {
        if ($game->id === $request['game_id'] && $game->user_id === $user->id) {

            $data = $request->validate([
                'quantity' => 'numeric|required',
            ]);

            DB::table('assets')->where('id', '=', $request->id)->update($data);
            return response('updated');
        } else {
            return response(null, 401);
        }
    }
    public function addChild(User $user, Game $game, Request $request)
    {
        if ($game->id === $request['game_id'] && $game->user_id === $user->id) {

            $data = $request->validate([
                'child_number' => 'numeric|required',
            ]);

            DB::table('liabilities')->where('id', '=', $request->id)->update($data);
            return response('updated');
        } else {
            return response(null, 401);
        }
    }
}
