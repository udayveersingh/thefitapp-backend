<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use App\Models\UserIncomeSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('users.index', compact('users'));
    }

    /**
     * user detail
     */

    public function userDetail($id)
    {
        $user = User::with('profile')->find($id);
        $user_income_summary = UserIncomeSummary::where('user_id', '=', $user->id)->get();
        $referral_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'Referral')->sum('credit_amount');
        $withdraw_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'WithDrawl')->where('withdrawl_status', '=', 'approved')->sum('debit_amount');
        $total_earning_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'StepTracker')->sum('credit_amount');
        $user_earning_balance = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'StepTracker')->get();
        $user_referral_balance = DB::table('user_income_summaries')
            ->select(DB::raw('DATE_FORMAT(user_income_summaries.transaction_date,"%m-%d-%Y") as date'), 'user_income_summaries.credit_amount', 'user_income_summaries.transaction_type', 'users.name')
            ->join('users', 'users.id', '=', 'user_income_summaries.referred_user_id')->where('user_income_summaries.user_id', '=', $user->id)->get();


        // dd($user_earning_balance);
        $totalBalance = UserIncomeSummary::where('user_id', '=', $user->id)->sum('credit_amount');

        // dd($user_income_summary);
        // if(is_null($user->profile)){
        //     return redirect()->route('users')->with('message','Profile Detail Not added.');
        // }
        $tasks = Task::get();
        return view('users.user-detail', compact('user', 'tasks', 'totalBalance', 'referral_balance', 'withdraw_balance', 'total_earning_balance', 'user_earning_balance', 'user_referral_balance'));
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
        return redirect()->back()->with('message', 'User Profile updated Successfully.');
    }

    public function stepTrackerEarnings()
    {
        $user_step_trackers = DB::table('user_income_summaries')
            ->select(DB::raw('DATE_FORMAT(user_income_summaries.transaction_date,"%m-%d-%Y") as date'), 'user_income_summaries.credit_amount','user_income_summaries.created_at','user_income_summaries.id','user_income_summaries.transaction_type', 'user_income_summaries.steps', 'users.name')
            ->join('users', 'users.id', '=', 'user_income_summaries.user_id')->where('transaction_type', '=', 'StepTracker')->orderBy(DB::raw("DATE_FORMAT(user_income_summaries.transaction_date,'%d-%m-%Y')"), 'DESC')->get();
        return view('reports.step_trackers_earning', compact('user_step_trackers'));
    }


    public function referralEarnings()
    {
        $user_referral_earnings = DB::table('user_income_summaries')
            ->select(DB::raw('DATE_FORMAT(user_income_summaries.transaction_date,"%m-%d-%Y") as date'), 'user_income_summaries.credit_amount', 'user_income_summaries.transaction_type', 'users.name')
            ->join('users', 'users.id', '=', 'user_income_summaries.user_id')->where('transaction_type', '=', 'Referral')->orderBy(DB::raw("DATE_FORMAT(user_income_summaries.transaction_date,'%d-%m-%Y')"), 'DESC')->get();
        return view('reports.referral_earnings', compact('user_referral_earnings'));
    }

    public function withdrawlList()
    {
        $users_withdrawl = DB::table('user_income_summaries')
        ->select(DB::raw('DATE_FORMAT(user_income_summaries.transaction_date,"%m-%d-%Y") as date'), 'user_income_summaries.debit_amount', 'user_income_summaries.transaction_type','users.name','user_income_summaries.withdrawl_status')
        ->join('users', 'users.id', '=', 'user_income_summaries.user_id')->where('transaction_type', '=','WithDrawl')->orderBy(DB::raw("DATE_FORMAT(user_income_summaries.transaction_date,'%d-%m-%Y')"), 'DESC')->get();

    return view('reports.withdrawl_list', compact('users_withdrawl'));

    }
}
