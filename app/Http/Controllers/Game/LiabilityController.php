<?php

namespace App\Http\Controllers\Game;

use App\Game;
use App\Http\Controllers\Controller;
use App\Liability;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiabilityController extends Controller
{
    private $liability;
    private $gameId;

    public function __construct(int $gameId = null)
    {
        $this->gameId = $gameId;
    }

    public function roleSetup(int $roleId)
    {
        $roleData = config()->get('playerroles.roleFull.' . $roleId);
        $this->updateTaxes($roleData['taxes']);
        $this->updateOther($roleData['other_expenses']);
        $this->addChild(0, $roleData['child_expenses']);
        $this->updateFlatLoan($roleData['flat_loan'], $roleData['flat_payment']);
        $this->updateStudyLoan($roleData['study_loan'], $roleData['study_payment']);
        $this->updateCarLoan($roleData['car_loan'], $roleData['car_payment']);
        $this->updateCreditLoan($roleData['credit_loan'], $roleData['credit_payment']);
        $this->updateConsumerLoan($roleData['consumer_loan'], $roleData['consumer_payment']);
    }

// fixed values update

    private function updateTaxes(int $cash_flow)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'taxes'],
        );

        $this->liability->type = 0;
        $this->liability->cash_flow = $cash_flow;
        $this->liability->save();
    }

    private function updateOther(int $cash_flow)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'other_expenses']
        );

        $this->liability->type = 0;
        $this->liability->cash_flow = $cash_flow;
        $this->liability->save();
    }

// child expenses

    private function addChild(int $child, int $cash_flow = 0)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'child_expenses']
        );

        if ($this->liability->child_number === null) {
            $this->liability->child_number = $child;
            $this->liability->cash_flow = $cash_flow;
        } else {
            $this->liability->child_number += $child;
        }

        $this->liability->type = 1;
        $this->liability->save();
    }

// loan payments and updates

    /**
     * If only @loan given:
     * @loan is subtracted from loan_size(DB) and recalcutes cash_flow(DB)
     * Else @loan and @cash_flow given it sets or updates loan row
     */
    private function updateFlatLoan(int $loan, int $cash_flow = -1)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'flat_loan']
        );

        if ($cash_flow === -1) {
            $this->liability->cash_flow *= ($this->liability->loan_size - $loan) / $this->liability->loan_size;
            $this->liability->loan_size -= $loan;
        } elseif ($cash_flow === 0) {
            $this->liability->cash_flow = 0;
            $this->liability->loan_size = 0;
        } else {
            $this->liability->cash_flow = $cash_flow;
            $this->liability->loan_size = $loan;
        }

        $this->liability->type = 2;
        $this->liability->save();
    }

    /**
     * If only @loan given:
     * @loan is subtracted from loan_size(DB) and recalcutes cash_flow(DB)
     * Else @loan and @cash_flow given it sets or updates loan row
     */
    private function updateStudyLoan(int $loan, int $cash_flow = -1)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'study_loan']
        );

        if ($cash_flow === -1) {
            $this->liability->cash_flow *= ($this->liability->loan_size - $loan) / $this->liability->loan_size;
            $this->liability->loan_size -= $loan;
        } elseif ($cash_flow === 0) {
            $this->liability->cash_flow = 0;
            $this->liability->loan_size = 0;
        } else {
            $this->liability->cash_flow = $cash_flow;
            $this->liability->loan_size = $loan;
        }

        $this->liability->type = 2;
        $this->liability->save();
    }

    /**
     * If only @loan given:
     * @loan is subtracted from loan_size(DB) and recalcutes cash_flow(DB)
     * Else @loan and @cash_flow given it sets or updates loan row
     */
    private function updateCarLoan(int $loan, int $cash_flow = -1)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'car_loan']
        );

        if ($cash_flow === -1) {
            $this->liability->cash_flow *= ($this->liability->loan_size - $loan) / $this->liability->loan_size;
            $this->liability->loan_size -= $loan;
        } elseif ($cash_flow === 0) {
            $this->liability->cash_flow = 0;
            $this->liability->loan_size = 0;
        } else {
            $this->liability->cash_flow = $cash_flow;
            $this->liability->loan_size = $loan;
        }

        $this->liability->type = 2;
        $this->liability->save();
    }

    /**
     * If only @loan given:
     * @loan is subtracted from loan_size(DB) and recalcutes cash_flow(DB)
     * Else @loan and @cash_flow given it sets or updates loan row
     */
    private function updateCreditLoan(int $loan, int $cash_flow = -1)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'credit_loan']
        );

        if ($cash_flow === -1) {
            $this->liability->cash_flow *= ($this->liability->loan_size - $loan) / $this->liability->loan_size;
            $this->liability->loan_size -= $loan;
        } elseif ($cash_flow === 0) {
            $this->liability->cash_flow = 0;
            $this->liability->loan_size = 0;
        } else {
            $this->liability->cash_flow = $cash_flow;
            $this->liability->loan_size = $loan;
        }

        $this->liability->type = 2;
        $this->liability->save();
    }

    /**
     * If only @loan given:
     * @loan is subtracted from loan_size(DB) and recalcutes cash_flow(DB)
     * Else @loan and @cash_flow given it sets or updates loan row
     */
    private function updateConsumerLoan(int $loan, int $cash_flow = -1)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'consumer_loan']
        );

        if ($cash_flow === -1) {
            $this->liability->cash_flow *= ($this->liability->loan_size - $loan) / $this->liability->loan_size;
            $this->liability->loan_size -= $loan;
        } elseif ($cash_flow === 0) {
            $this->liability->cash_flow = 0;
            $this->liability->loan_size = 0;
        } else {
            $this->liability->cash_flow = $cash_flow;
            $this->liability->loan_size = $loan;
        }

        $this->liability->type = 2;
        $this->liability->save();
    }

    /**
     * If @loan is positive bank loan is increased
     */
    private function updateBankLoan(int $loan)
    {
        $this->liability = Liability::firstOrCreate(
            ['game_id' => $this->gameId, 'name' => 'consumer_loan']
        );

        if (isset($this->liability->loan_size)) {
            $this->liability->loan_size += $loan;
            $this->liability->cash_flow = $this->liability->loan_size * 0.1;
        } else {
            $this->liability->loan_size = 0;
            $this->liability->cash_flow = 0;
        }

        $this->liability->type = 2;
        $this->liability->save();
    }

    public function getAll(User $user, Game $game)
    {
        if ($game->user_id === $user->id) {
            $liabilities = DB::table('liabilities')
                ->where('game_id', '=', $game->id)
                ->get();

            return response($liabilities, 200);
        } else {
            return response(403);
        }
    }
}
