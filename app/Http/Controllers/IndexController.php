<?php

namespace App\Http\Controllers;

use App\Models\Attempts;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    public function index()
    {
        if (session()->has("user")) {
            $data = DB::table('tblAttempts')
                ->join('tblUser', 'tblUser.userId', '=', 'tblAttempts.atpUser')
                ->select('tblAttempts.*', 'tblUser.userFirstName', 'tblUser.userProfile')
                ->get();
            $count = 0;

            // return statement
            return view('index', compact('data', 'count'));
        } else {
            return redirect()->route('login');
        }
    }

    public function data()
    {
        return view('data');
    }

    public function insertData(Request $request)
    {
        $title = $request->input("atpTitle");
        $desc = $request->input("atpDesc");
        $amount = $request->input("atpAmount");
        $platform = $request->input("atpPlatform");
        DB::table('tblAttempts')->insert([
            'atpProjectName' => $title,
            'atpPlatform' => $platform,
            'atpDescription' => $desc,
            'atpProjectAmount' => $amount,
            'atpStatus' => "1",
            'atpUser' => session('user')->userId
        ]);

        return redirect()->route('index');
    }
}
