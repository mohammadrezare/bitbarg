<?php

namespace App\Mail;

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewArrivals extends Mailable
{
    use Queueable, SerializesModels;

    protected $new_arrival;
    protected $user;

    public function __construct($user, $new_arrival)
    {
        $this->user = $user;
        $this->new_arrival = $new_arrival;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.newarrivals')
            ->subject('Notify about your task')
            ->from('bitbarg@company.com', 'Bitbarg')
            ->with([
                'user'=> $this->user,
                'new_arrival' => $this->new_arrival,
            ]);
    }
}
