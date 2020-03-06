<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class InviteCode implements Rule
{
    private $roomId;

    public function __construct($roomId)
    {
        $this->roomId = $roomId;
    }

    public function passes($attribute, $value)
    {
        $room = DB::table('rooms')
            ->where('id', '=', $this->roomId)
            ->first();

        if (isset($room->invite_code) && $room->invite_code === $value) return true;

        return false;
    }

    public function message()
    {
        return 'Invalid room join code';
    }
}
