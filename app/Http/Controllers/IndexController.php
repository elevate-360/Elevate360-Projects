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
            // all attempts details
            $data = DB::table('tblAttempts')
                ->join('tblUser', 'tblUser.userId', '=', 'tblAttempts.atpUser')
                ->select('tblAttempts.*', 'tblUser.userFirstName', 'tblUser.userProfile')
                ->get();

            // individual attempts summary
            $idvData = DB::table('tblAttempts')
            ->join('tblUser', 'tblUser.userId', '=', 'tblAttempts.atpUser')
            ->select('tblUser.userFirstName', 'tblUser.userLastName', 'tblUser.userProfile', 'tblUser.userRole', DB::raw('SUM(CASE WHEN `atpStatus` = \'0\' THEN 1 ELSE 0 END) AS declined, SUM(CASE WHEN `atpStatus` = \'1\' THEN 1 ELSE 0 END) AS pending, SUM(CASE WHEN `atpStatus` = \'2\' THEN 1 ELSE 0 END) AS accepted'))
            ->groupBy('tblUser.userId')
            ->get();

            // count variables
            $count = 0;
            $userCount = 0;

            // return statement
            return view('index', compact('data', 'idvData', 'count', 'userCount'));
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
        $title = trim($request->input("atpTitle"));
        $link = trim($request->input("atpLink"));
        $desc = trim($request->input("atpDesc"));
        $amount = trim($request->input("atpAmount"));
        $platform = trim($request->input("atpPlatform"));
        DB::table('tblAttempts')->insert([
            'atpProjectName' => $title,
            'atpLink' => $link,
            'atpPlatform' => $platform,
            'atpDescription' => $desc,
            'atpProjectAmount' => $amount,
            'atpStatus' => "1",
            'atpUser' => session('user')->userId
        ]);

        return redirect()->route('index');
    }
}
