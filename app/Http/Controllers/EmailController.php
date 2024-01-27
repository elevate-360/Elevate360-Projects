<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Mail\LoginSuccess;
use App\Models\LoginLog;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent as Agent;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailController extends BaseController
{
    public function view()
    {
        if (session()->has("user")) {
            return view('email');
        } else {
            return redirect()->route('login');
        }
    }

    public function sendEmail(Request $request)
    {
        dd(session("user")->userEmail);
        $email = explode(",", trim($request->input("email")));
        $name = $request->input("name");
        $customData = array(
            "subject" => $request->input("subject"),
            "to" => $email,
            "name" => $name,
            "fromEmail" => $email,
            "fromName" => $name,
            "message" => $request->input("message"),
            "date" => date("Y-m-d")
        );
        Mail::to($email)->send(new Email($customData));

        return redirect()->route('index')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }
}
