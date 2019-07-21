<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Support\Facades\Mail;
use App\User;

class VerifyEmail extends Notification 
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */


    //for mail,, and sms add korte chaile 'nexmo use korte hbe'

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
        return (new MailMessage)
                    ->line('Dear' . $this->user->name)
                    ->line('Your Account Has Been Created Successfully! Please verify your email and continue the process. ! Thank You')
                    ->action('Click Here To Verify', route('verifyy', $this->user->email_verification_token));
                  
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */


   // for sms

//     public function toNexmo($notifiable)
// {
//     return (new NexmoMessage)
//                 ->content('Dear'. $this->user->name.'.Your account is registerd. -Wish list');
// }







    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
