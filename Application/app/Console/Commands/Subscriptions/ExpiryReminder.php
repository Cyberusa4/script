<?php

namespace App\Console\Commands\Subscriptions;

use App\Models\Subscription;
use App\Notifications\Subscriptions\ExpirySubscriptionReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class ExpiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:expiry-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email for reminding the user after subscription expired';

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
            $subscriptions = Subscription::whereActive()->notLifetime()->with(['user', 'plan'])->get();
            $delete_interval = (settings('expired_subscriptions_files_delete') > 1 ?
                settings('expired_subscriptions_files_delete') . ' ' . lang('days') : settings('expired_subscriptions_files_delete') . ' ' . lang('day'));
            foreach ($subscriptions as $subscription) {
                if (!$subscription->plan->free_plan) {
                    if (Carbon::now() > $subscription->expiry_at) {
                        $title = lang('Your subscription has been expired', 'notifications');
                        $image = asset('images/icons/expired.png');
                        $link = route('user.subscription');
                        userNotify($subscription->user->id, $title, $image, $link);
                        $title = str_replace('{delete_interval}', $delete_interval, lang('Your files will be deleted after {delete_interval}', 'notifications'));
                        $image = asset('images/icons/deleting-files.png');
                        userNotify($subscription->user->id, $title, $image);
                        $details['name'] = $subscription->user->firstname;
                        $details['delete_interval'] = $delete_interval;
                        $details['planTable'] = [
                            'title' => mailTemplates('Your Subscription Details', 'subscription expiry notification'),
                            'head' => [
                                'plan_name' => mailTemplates('Plan name', 'subscription expiry notification'),
                                'plan_interval' => mailTemplates('Interval', 'subscription expiry notification'),
                                'plan_price' => mailTemplates('Price', 'subscription expiry notification'),
                            ],
                            'body' => [
                                'plan_name' => $subscription->plan->name,
                                'plan_interval' => formatInterval($subscription->plan->interval),
                                'plan_price' => priceSymbol($subscription->plan->price),
                            ],
                        ];
                        if (settings('mail_status')) {
                            Notification::send($subscription->user, new ExpirySubscriptionReminderNotification($details));
                        }
                    }
                }
            }
        }
    }
}
