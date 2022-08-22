<?php

namespace App\Console\Commands\Subscriptions;

use App\Models\Plan;
use App\Models\Subscription;
use App\Notifications\Subscriptions\RenewalFreePlanNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class RenewalFreePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:renewal-free';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renewal the free subscription and inform the users via email';

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
            $plan = Plan::whereFree()->notLifetime()->first();
            if (!is_null($plan)) {
                $subscriptions = Subscription::where([['plan_id', $plan->id], ['expiry_at', '<=', Carbon::now()], ['status', 1]])->with(['user', 'plan'])->get();
                foreach ($subscriptions as $subscription) {
                    if ($subscription->plan->interval == 1) {
                        $expiry_at = Carbon::now()->addMonth();
                    } elseif ($subscription->plan->interval == 2) {
                        $expiry_at = Carbon::now()->addYear();
                    }
                    $update = $subscription->update(['expiry_at' => $expiry_at]);
                    if ($update) {
                        $title = lang('Your free subscription has been renewed', 'notifications');
                        $image = asset('images/icons/renewed.png');
                        $link = route('user.subscription');
                        userNotify($subscription->user->id, $title, $image, $link);
                        $details['name'] = $subscription->user->firstname;
                        if (settings('mail_status')) {
                            Notification::send($subscription->user, new RenewalFreePlanNotification($details));
                        }
                    }
                }
            }
        }
    }
}
