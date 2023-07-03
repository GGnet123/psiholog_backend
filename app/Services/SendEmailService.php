<?php
namespace App\Services;

use App\Mail\SendRegCodeMail;
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
            Mail::to($this->to)->send(new SendRegCodeMail($this->message));
        } catch (\Exception|\Error $exception) {
            return false;
        }
        return true;
    }
}
