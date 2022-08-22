<?php

namespace App\Notifications\Subscriptions;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RenewalFreePlanNotification extends Notification
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
        $subcopy = mailTemplates('If you are having trouble clicking the button, just copy and paste the URL below into your web browser', 'free subscription renewal notification');
        return (new MailMessage)
            ->subject(mailTemplates('Your free subscription has been renewed', 'free subscription renewal notification'))
            ->greeting(str_replace('{user_firstname}', $this->details['name'], mailTemplates('Hi {user_firstname},', 'free subscription renewal notification')))
            ->line(mailTemplates('Great news! Your free subscription has officially been renewed. the following email is just to inform you that you can start using your subscription from now.', 'free subscription renewal notification'))
            ->action(mailTemplates('Start uploading files', 'free subscription renewal notification'), url('/'))
            ->line(str_replace('{website_name}', settings('website_name'), mailTemplates('You are receiving this email because you have an account in {website_name} If you get this email by mistake, no further action is required.', 'free subscription renewal notification')))
            ->salutation(mailTemplates('Regards', 'free subscription renewal notification'))
            ->markdown('vendor.notifications.email', [
                'subcopy' => $subcopy,
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
