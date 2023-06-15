<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Machine;
use Carbon\Carbon;

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
        $user = User::find($idU);
        if (is_null($user->email_verified_at)) {
             // Set the email_verified_at column to the current date and time
            $user->email_verified_at = Carbon::now();
            $user->save();
            // Return a response with a status of 200
            return response()->json(['message' => 'User is Verified Now'], 200);
        }
        else
        {
            return response()->json(['message' => 'User already Verified'], 400);
        }

    }
    public function verify_machine(Request $request)
    {
        $idM = $request->input('id');
        $idU = $request->input('idU');
        $machine = Machine::find($idM);
        $machine->active = '1';
        $machine->save();
        $data = Machine::where('user_id', $idU)->get(); // Replace 'some_column' with your actual column name

        return response()->json(['message' => 'Machine is Verified Now' , 'data' => $data], 200);

    }
    public function restrict_machine(Request $request)
    {
        $idM = $request->input('id');
        $idU = $request->input('idU');
        $machine = Machine::find($idM);
        $machine->active = '0';
        $machine->save();
        $data = Machine::where('user_id', $idU)->get(); // Replace 'some_column' with your actual column name
          return response()->json(['message' => 'Machine is Restricted Now' , 'data' => $data], 200);

    }



}
