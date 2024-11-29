<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class DeductCoinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    public $tries = 3;

    public function __construct($userId)
    {
        $this->userId = $userId; // Chỉ lưu ID người dùng
    }

    public function handle()
    {
        try {
            // Lấy thông tin người dùng từ database
            $user = User::find($this->userId);

            if (!$user) {
                Log::warning("Người dùng không tồn tại, hủy job", ['user_id' => $this->userId]);
                return; // Người dùng không tồn tại, dừng job
            }

            // Kiểm tra điều kiện
            if (!$user->is_online) {
                Log::info("Người dùng không online, hủy job", ['user_id' => $user->id]);
                return; // Người dùng offline, hủy job
            }

            if ($user->coin <= 0) {
                Log::info("Người dùng không còn coin, hủy job", ['user_id' => $user->id]);
                return; // Không còn coin để trừ, hủy job
            }

            // Trừ coin
            $user->decrement('coin');
            Log::info("Đã trừ 1 coin", [
                'user_id' => $user->id,
                'coin_còn_lại' => $user->coin,
            ]);

            // Dispatch job mới sau 1 phút
            $job = (new DeductCoinJob($user->id))->delay(Carbon::now()->addMinute(2));
            dispatch($job);
        } catch (\Exception $e) {
            Log::error("Lỗi xảy ra trong DeductCoinJob", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $this->userId,
            ]);
            throw $e; // Ném lỗi để retry hoặc hủy
        }
    }
}
