<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use MOdules\Workorder\Entities\Workorder;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    public $workorder;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Workorder $workorder)
    {
        $this->workorder = $workorder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('name');
    }
}
