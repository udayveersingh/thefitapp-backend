<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use App\Models\UserIncomeSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role','!=','admin')->get();
        return view('users.index', compact('users'));
    }

    /**
     * user detail
     */

     Public function userDetail($id)
     {
        $user = User::with('profile')->find($id);
        $user_income_summary = UserIncomeSummary::where('user_id','=',$user->id)->get();
        $referral_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type','=','Referral')->sum('credit_amount');
        $withdraw_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type','=','WithDrawl')->where('withdrawl_status','=','approved')->sum('debit_amount');
        $total_earning_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type','=','StepTracker')->sum('credit_amount');
        $user_earning_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type','=','StepTracker')->get();
        // dd($user_earning_balance);
        $totalBalance = UserIncomeSummary::where('user_id', '=', $user->id)->sum('credit_amount');
        // dd($user_income_summary);
        // if(is_null($user->profile)){
        //     return redirect()->route('users')->with('message','Profile Detail Not added.');
        // }
        $tasks = Task::get();
        return view('users.user-detail',compact('user','tasks','totalBalance','referral_balance','withdraw_balance','total_earning_balance','user_earning_balance'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $user = User::with('profile')->find($id);
         return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();
        return redirect()->back()->with('message','User Profile updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
