<?php

namespace App\Mail;

use App\Penjualan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PenjualanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $penjualan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Penjualan $penjualan)
    {
        $this->penjualan = $penjualan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.penjualan');
    }
}
