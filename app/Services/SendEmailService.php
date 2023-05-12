<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailService {
    public string $message = '';
    public string $subject = '';
    public string $to = '';

    public function __construct($to, $subject, $message)
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->to = $to;
    }

    function send():bool {
        try {
            $data = array('name'=> env("MAIL_FROM"));
            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to($this->to, "")->subject($this->subject);
                $message->from(env("MAIL_USERNAME"), env("MAIL_FROM"));
            });
        } catch (\Exception|\Error $exception) {
            return false;
        }
        return true;
    }
}
