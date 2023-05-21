<?php
namespace App\Services;

use App\Mail\SendRegCodeMail;
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
            /*$data = array('name'=> env("MAIL_FROM_ADDRESS"));
            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to($this->to, "")->subject($this->subject);
                $message->from(env("MAIL_USERNAME"), env("MAIL_FROM_ADDRESS"));
            });*/

            Mail::to($this->to)->send(new SendRegCodeMail($this->message));

        } catch (\Exception|\Error $exception) {
            throw $exception;
            return false;
        }
        return true;
    }
}
