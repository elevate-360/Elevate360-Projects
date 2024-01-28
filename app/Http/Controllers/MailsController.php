<?php

namespace App\Http\Controllers;

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
}
