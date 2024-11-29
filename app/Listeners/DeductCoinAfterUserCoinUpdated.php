<?php

namespace App\Listeners;

use App\Events\UserCoinUpdated;
use App\Jobs\DeductCoinJob;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeductCoinAfterUserCoinUpdated implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  UserCoinUpdated  $event
     * @return void
     */
    public function handle(UserCoinUpdated $event)
    {
        // Lấy người dùng từ event
        $user = $event->user;

        // Dispatch lại job sau khi coin được nạp thêm
        $job = (new DeductCoinJob($user->id))->delay(Carbon::now()->addMinutes(1));
        dispatch($job);
    }
}
