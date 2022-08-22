<?php

namespace App\Notifications\Subscriptions;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RenewalReminderNotification extends Notification
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subcopy = mailTemplates('If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'subscription renewal reminder notification');
        return (new MailMessage)
            ->subject(mailTemplates('RENEWAL NOTICE: Your subscription is expiring soon', 'subscription renewal reminder notification'))
            ->greeting(str_replace('{user_firstname}', $this->details['name'], mailTemplates('Hi {user_firstname},', 'subscription renewal reminder notification')))
            ->line(str_replace('{expiry_date}', $this->details['expiry_date'], mailTemplates('Your subscription is about to expire on {expiry_date}, please renew it before it gets expiry to avoid losing your files.', 'subscription renewal reminder notification')))
            ->action(mailTemplates('Renew Now', 'Subscription renewal reminder notification'), route('user.subscription'))
            ->line(mailTemplates("Not ready to renew? No problem. We'll remind you closer to the expiry date, so you don't miss the deadline.", 'subscription renewal reminder notification'))
            ->salutation(mailTemplates('Regards', 'subscription renewal reminder notification'))
            ->markdown('vendor.notifications.email', [
                'subcopy' => $subcopy,
                'planTable' => $this->details['planTable'],
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
