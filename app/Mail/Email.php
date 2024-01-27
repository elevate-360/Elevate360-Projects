<?php

namespace App\Mail;

use App\Models\Mails;
use Illuminate\Mail\Mailable;

class Email extends Mailable
{
    public $data;
    public $fromEmail;
    public $fromName;

    public function __construct($customData)
    {
        $this->data = $customData;
        $this->fromEmail = $customData["fromEmail"];
        $this->fromName = $customData["fromName"];
    }

    public function build()
    {
        $insertData = array(
            "mailBy" => session("user")->userId,
            "mailTo" => json_encode($this->data["to"]),
            "mailToName" => $this->data["name"],
            "mailSubject" => $this->data["subject"],
            "mailContent" => $this->data["message"]
        );
        Mails::insert($insertData);
        return $this->from($this->fromEmail, $this->fromName)->subject($this->data["subject"])
            ->view('emails.email');
    }
}
