<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MailProvider\InboundMail;
use App\Models\Inbox;
use App\Models\Mails;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\DB;

class MailsController extends BaseController
{
    public function index()
    {
        if (session()->has("user")) {
            $data = Mails::orderBy("mailDate", "desc")->get();
            $userLogin = DB::table("tblUserLoginLog")
            ->join("tblUser", "tblUser.userId = tblUserLoginLog.userId")
            ->orderBy("loginDate", "desc")
            ->orderBy("loginTime", "desc")
            ->select("tblUser.userFirstName", "tblUser.userLastName", "tblUserLoginLog.loginDate", "tblUserLoginLog.loginTime", "tblUserLoginLog.operatingSystem", "tblUserLoginLog.ipAddress", "loginCount");
            $count = 0;
            $usercount = 0;
            return view('mails', compact('data', 'userLogin', 'count', "usercount"));
        } else {
            return redirect()->route('login');
        }
    }

    public function getMail()
    {
        return view('emails.email', ["data" => json_decode($_GET["data"], true)]);
    }

    public function render($id)
    {
        $data = Inbox::where('id', $id)->value('body');
        return view('render', compact("data"));
    }

    public function getInboundMails() {
        // Get All Inbound Mails
        $mails = Inbox::orderBy("date", "DESC")->get();

        $count = 0;
        return view("inbox", compact("mails", "count"));
    }
}
