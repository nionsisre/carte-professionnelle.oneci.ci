<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailONECI extends Mailable {

    use Queueable, SerializesModels;
    public $view_layout_name, $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view_layout_name, $data) {
        $this->view_layout_name = $view_layout_name;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from(env('MAIL_USERNAME'))
                    ->subject("Votre fiche d'identification d'abonné mobile ONECI")
                    ->view($this->view_layout_name, $this->data);
    }

}
