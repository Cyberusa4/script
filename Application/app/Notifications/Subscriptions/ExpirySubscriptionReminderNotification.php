<?php

namespace App\Notifications\Subscriptions;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpirySubscriptionReminderNotification extends Notification
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
        $subcopy = mailTemplates('If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'subscription expiry notification');
        return (new MailMessage)
            ->subject(mailTemplates('EXPIRY NOTICE: Your subscription has been expired', 'subscription expiry notification'))
            ->greeting(str_replace('{user_firstname}', $this->details['name'], mailTemplates('Hi {user_firstname},', 'subscription expiry notification')))
            ->line(str_replace('{delete_interval}', $this->details['delete_interval'], mailTemplates('Your subscription has been expired, and we are about deleting your files, if you did not renew the subscription after {delete_interval} from now.', 'subscription expiry notification')))
            ->level('error')
            ->action(mailTemplates('Renew Now', 'subscription expiry notification'), route('user.subscription'))
            ->line(str_replace('{website_name}', settings('website_name'), mailTemplates('You are receiving this email because you have an account in {website_name} If you get this email by mistake, no further action is required.', 'subscription expiry notification')))
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
