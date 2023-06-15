<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class MailONECI extends Mailable {

    use Queueable, SerializesModels;
    public $view_layout_name, $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view_layout_name, $data, $subject = "") {
        $this->view_layout_name = $view_layout_name;
        $this->data = $data;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from(env('MAIL_USERNAME'))
                    ->subject($this->subject)
                    ->view($this->view_layout_name, $this->data);
    }

    /**
     * (PHP 5, PHP 7, PHP 8+)<br/>
     * Send custom email using a blade view layout<br/><br/>
     * <b>void</b> sendMailTemplate(<b>array</b> $data, <b>String</b> $blade_view_layout)<br/>
     * @param String $blade_view_layout <p>Blade view layout path.</p>
     * @param array $data <p>Blade view layout data</p>
     * @return bool Return true if mail is sent successfully
     */
    public static function sendMailTemplate($blade_view_layout, $data, $subject = "ONECI") {
        $data['is_email'] = true;
        if (App::environment(['staging', 'production'])) {
            /* We use the method below because production server doesn't allow custom SMTP server */
            $headers = 'From: ONECI <' .env('MAIL_USERNAME').">\r\n";
            $headers .= 'Reply-To: ' .env('MAIL_USERNAME')."\r\n";
            /*$headers .= "CC: info@oneci.ci\r\n";*/
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $to = $data['email'];
            $content = view($blade_view_layout, $data);
            mail($to, $subject, $content, $headers);
            if (mail($to, $subject, $content, $headers)) {
                return true;
            } else {
                return false;
            }
        } else {
            Mail::to($data['email'])->queue(new MailONECI($blade_view_layout, $data, $subject));
            return true;
        }
    }

}
