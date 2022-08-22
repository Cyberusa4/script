<?php

namespace App\Console\Commands\Subscriptions;

use App\Models\FileEntry;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired subscriptions after the expiration and no renewal';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (licenceType(2)) {
            $subscriptions = Subscription::where([['expiry_at', '<', Carbon::now()], ['status', 1]])->with('plan')->get();
            foreach ($subscriptions as $subscription) {
                if ($subscription->plan->price != 0 || $subscription->plan->interval != 3) {
                    if (Carbon::parse($subscription->expiry_at)->addDays(settings('expired_subscriptions_files_delete')) < Carbon::now()) {
                        $fileEntries = FileEntry::where('user_id', $subscription->user_id)->get();
                        $transactions = Transaction::where('user_id', $subscription->user_id)->get();
                        $notifications = UserNotification::where('user_id', $subscription->user_id)->get();
                        if ($fileEntries->count() > 0) {
                            foreach ($fileEntries as $fileEntry) {
                                $handler = $fileEntry->storageProvider->handler;
                                $delete = $handler::delete($fileEntry->path);
                                if ($delete) {
                                    $fileEntry->forceDelete();
                                }
                            }
                        }
                        if ($transactions->count() > 0) {
                            foreach ($transactions as $transaction) {
                                $transaction->delete();
                            }
                        }
                        if ($notifications->count() > 0) {
                            foreach ($notifications as $notification) {
                                $notification->delete();
                            }
                        }
                        $subscription->delete();
                    }
                }
            }
        }
    }
}
