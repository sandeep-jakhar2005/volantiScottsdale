<?php

namespace ACME\paymentProfile\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class adminOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $admin_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order ,$admin_name)
    {
        $this->order = $order;
        $this->admin_name = $admin_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Log::info('admin page');
        return $this->subject(trans('shop::app.mail.order.subject'))->view('mail.admin-order-notify');

    }
    
}