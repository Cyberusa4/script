<?php

namespace App\Console\Commands\Subscriptions;

use App\Models\Subscription;
use App\Notifications\Subscriptions\RenewalReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class RenewalReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:renewal-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email to remind the user about subscription renewal';

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
            foreach ($subscriptions as $subscription) {
                if (!$subscription->plan->free_plan) {
                    if (Carbon::now() >= Carbon::parse($subscription->expiry_at)->subDays(6) && Carbon::now() < $subscription->expiry_at) {
                        $title = lang('Your subscription will expiry soon', 'notifications');
                        $image = asset('images/icons/expiry.png');
                        $link = route('user.subscription');
                        userNotify($subscription->user->id, $title, $image, $link);
                        $details['name'] = $subscription->user->firstname;
                        $details['expiry_date'] = vDate($subscription->expiry_at);
                        $details['planTable'] = [
                            'title' => mailTemplates('Your Subscription Details', 'subscription renewal reminder notification'),
                            'head' => [
                                'plan_name' => mailTemplates('Plan name', 'subscription renewal reminder notification'),
                                'plan_interval' => mailTemplates('Interval', 'subscription renewal reminder notification'),
                                'plan_price' => mailTemplates('Price', 'subscription renewal reminder notification'),
                            ],
                            'body' => [
                                'plan_name' => $subscription->plan->name,
                                'plan_interval' => formatInterval($subscription->plan->interval),
                                'plan_price' => priceSymbol($subscription->plan->price),
                            ],
                        ];
                        if (settings('mail_status')) {
                            Notification::send($subscription->user, new RenewalReminderNotification($details));
                        }
                    }
                }
            }
        }
    }
}
