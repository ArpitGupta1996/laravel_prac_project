<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

class HighchartController extends Controller
{
    public function handleChart(){
        $data = User::select(DB::raw("COUNT(*) as count"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('count');


                return view('users.data', compact('data'));
    }


    public function indiamap(){
        return view('highchart.map');
    }
}
