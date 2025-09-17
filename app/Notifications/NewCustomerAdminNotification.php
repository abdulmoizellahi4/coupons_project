<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Customer;

class NewCustomerAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $customer;

    /**
     * Create a new notification instance.
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('🆕 New Customer Registration - Big Saving Hub')
            ->greeting('Hello Admin!')
            ->line('A new customer has registered on Big Saving Hub.')
            ->line('**Customer Details:**')
            ->line('👤 **Name:** ' . $this->customer->name)
            ->line('📧 **Email:** ' . $this->customer->email)
            ->line('📅 **Registration Date:** ' . $this->customer->created_at->format('F d, Y H:i:s'))
            ->line('📧 **Newsletter Subscription:** ' . ($this->customer->is_subscribed ? 'Yes' : 'No'))
            ->line('✅ **Account Status:** Active')
            ->action('View Customer Details', route('admin.customers.show', $this->customer->id))
            ->line('You can manage this customer from the admin dashboard.')
            ->salutation('Best regards,<br>Big Saving Hub System');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'customer_id' => $this->customer->id,
            'customer_name' => $this->customer->name,
            'customer_email' => $this->customer->email,
            'registration_date' => $this->customer->created_at,
            'is_subscribed' => $this->customer->is_subscribed,
        ];
    }
}

