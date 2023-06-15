<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Machine;

class DashboardController extends Controller
{
    //
    public function home()
    {
        $allUsers = User::withCount('machines')->where('is_admin', '!=', 1)->get();
        $allMachines = Machine::where('active', 1)->count();

        $countMachines = Machine::count();
        $countUsers = User::count();
        //$cardDetails = AccountDetail::where('user_id',Auth::user()->id)->get();
        return view('admin.home',get_defined_vars());
    }

    public function import()
    {
        //$cardDetails = AccountDetail::where('user_id',Auth::user()->id)->get();
        return view('admin.import',get_defined_vars());
    }

    public function get_machine_data(Request $request)
    {
        $idU = $request->input('id');

        // Retrieve data based on the provided condition
        $data = Machine::where('user_id', $idU)->get(); // Replace 'some_column' with your actual column name
        return response()->json($data);
    }

    public function verify_user(Request $request)
    {
        $idU = $request->input('id');

        // Retrieve data based on the provided condition
        $data = Machine::where('user_id', $idU)->get(); // Replace 'some_column' with your actual column name
        return response()->json($data);
    }


}
