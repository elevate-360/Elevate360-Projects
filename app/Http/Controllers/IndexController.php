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
        $traTitle = $request->input("traTitle");
        $traEntity = $request->input("traEntity");
        $traAmount = $request->input("traAmount");
        $traType = (is_null($request->input("traType")) ? "0" : "1");
        $traMethod = $request->input("traMethod");
        DB::table('tblTransection')->insert([
            'traTitle' => $traTitle,
            'traEntity' => $traEntity,
            'traAmount' => $traAmount,
            'traType' => $traType,
            'traMethod' => $traMethod,
            'traUserId' => session('user')->userId
        ]);

        return redirect()->route('index');
    }
}
