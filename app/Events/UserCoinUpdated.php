<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserCoinUpdated
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
