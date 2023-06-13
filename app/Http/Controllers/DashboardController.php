<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function home()
    {
        //$cardDetails = AccountDetail::where('user_id',Auth::user()->id)->get();
        return view('admin.home',get_defined_vars());
    }

    public function import()
    {
        //$cardDetails = AccountDetail::where('user_id',Auth::user()->id)->get();
        return view('admin.import',get_defined_vars());
    }

}
