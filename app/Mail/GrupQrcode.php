<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Klub;

class GrupQrcode extends Mailable
{
    use Queueable, SerializesModels;
    public $grup;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Klub $klub)
    {
        $this->grup = $klub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registrasi Lomba Berhasil')
                    ->view('mail')
                    ->text('mail-plain')
                    ->attach(public_path('uploaded/qrcode/'.$this->grup->grup_number.'.pdf'));
    }
}
