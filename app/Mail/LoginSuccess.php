<?php

namespace App\Mail;

use App\Models\Mails;
use Illuminate\Mail\Mailable;

class LoginSuccess extends Mailable
{
    public $data;
    public $fromEmail = "no-reply@elevate360.in";
    public $fromName = "Support Team | Elevate360";

    public function __construct($customData)
    {
        $this->data = $customData;
        $this->data["message"] = "<div style=\"text-align: justify;\">Great to see you here! Dive into your experience and enjoy all that we have to offer. If there's anything you need, remember, help is just a click away.</div><div style=\"text-align: justify;\">🔒 <b>Quick Security Check:</b> If you didn't attempt this login, please take a moment to reset your password right away for your account's safety.</div><div style=\"text-align: justify; \">Explore with confidence!</div>";
    }

    public function build()
    {
        $insertData = array(
            "mailBy" => $this->data["userId"],
            "mailTo" => json_encode($this->data["to"]),
            "mailToName" => $this->data["name"],
            "mailSubject" => "Login Attempted - Project Management App",
            "mailContent" => $this->data["message"]
        );
        Mails::insert($insertData);
        return $this->from($this->fromEmail, $this->fromName)->subject('Login Attempted - Project Management App')
            ->view('emails.email');
    }
}
