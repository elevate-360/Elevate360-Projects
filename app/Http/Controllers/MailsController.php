<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MailProvider\InboundMail;
use App\Models\Mails;
use Illuminate\Routing\Controller as BaseController;

class MailsController extends BaseController
{
    public function index()
    {
        if (session()->has("user")) {
            $data = Mails::orderBy("mailDate", "desc")->get();
            $count = 0;
            return view('mails', compact('data', 'count'));
        } else {
            return redirect()->route('login');
        }
    }

    public function getMail()
    {
        return view('emails.email', ["data" => json_decode($_GET["data"], true)]);
    }

    public function getBody()
    {
        return view('render', ["data" => ($_GET["data"])]);
    }

    public function getInboundMails() {
        // Get All Inbound Mails
        $messages  = InboundMail::getMails();
        $mails = array();
        foreach ($messages as $message) {
            $mails[] = array(
                "subject" => $message->getSubject(),
                "body" => $message->getHTMLBody(),
                "fromEmail" => $message->getFrom()[0]->mail,
                "fromName" => $message->getFrom()[0]->personal,
                "toEmail" => $message->getTo(),
                "time" => $message->getdate()[0]->format('d M, Y h:i:s a')
            );
        }

        $count = 0;
        return view("inbox", compact("mails", "count"));
    }
}
