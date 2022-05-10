<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderPurchase extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        $this->order = $orderId;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Order Purchase Successfully. Order Address Is {$this->order[0]->address} ";

        return $this->subject($subject)
                    ->view('emails.purchase');
    }
}
