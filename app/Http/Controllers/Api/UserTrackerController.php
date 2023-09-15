<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserIncomeSummary;
use Illuminate\Http\Request;
use App\Models\UserTracker;
use Illuminate\Support\Facades\Validator;
use DB;

class UserTrackerController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if (is_null($user)) {
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }
        $user_tracker = UserTracker::where('user_id', '=', $user->id)->get();
        if (!empty($user_tracker)) {
            return response()->json(['success' => true, 'data' => $user_tracker], 200);
        } else {
            return response()->json(['success' => 'true'], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'step_count' => 'required',
            'calories' => 'required',
            'move_min' => 'required',
            'miles' => 'required',
            // 'reward_amount' => 'required',
            'step_count_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }
        $user = auth()->user();
        $user_tracker = UserTracker::where('step_count_date', '=', $request->step_count_date)->where('user_id', '=', $user->id)->first();
        // dd($user_tracker);
        if (is_null($user_tracker)) {
            $user_tracker = new UserTracker();
            $user_tracker->user_id = $user->id;
            $user_tracker->step_count = $request->step_count;
            $user_tracker->calories = $request->calories;
            $user_tracker->move_min = $request->move_min;
            $user_tracker->miles = $request->miles;
            $user_tracker->step_count_date = $request->step_count_date;
        } else {
            $user_tracker = UserTracker::find($user_tracker->id);
            // $total_step_count =  (int) ($request->step_count) + (int)($user_tracker->step_count);
            // $calories = (int) ($request->calories) + (int) ($user_tracker->calories);
            // $move_min = (int) ($request->move_min) + (int) ($user_tracker->move_min);
            // $miles = (int) ($request->miles) + (int) ($user_tracker->miles);
            $user_tracker->step_count = $request->step_count;
            $user_tracker->calories = $request->calories;
            $user_tracker->move_min =$request->move_min;
            $user_tracker->miles =  $request->miles;
            $user_tracker->step_count_date = $request->step_count_date;
        }

        // $minSteps = 5000;
        // $stepRewards = 0.50;
        // $firstLevelRewards = 0.25;
        // $secondLevelRewards = 0.10;

        //get data of settings
        $setting = getSettings();
        $minSteps =  $setting['minimum_steps'];
        $stepRewards = $setting['step_rewards'];
        $firstLevelRewards = $setting['first_level_commission'];
        $secondLevelRewards = $setting['second_level_commission'];
        if ($request->step_count >= $minSteps) {
            // $user_tracker->reward_amount = ((int) ($total_step_count / $minSteps)) * $stepRewards;
            $user_tracker->reward_amount = $stepRewards;
        }
        // $user_tracker->save();
        // dd($user_tracker);
        if ($user_tracker->save()) {
            if ($user_tracker->reward_amount) {
                $userIncomeSummary = UserIncomeSummary::where(['user_id' => $user->id])->where(DB::raw('DATE(transaction_date)'), "=", $request->step_count_date)->first();
                if (is_null($userIncomeSummary)) {
                    $userIncomeSummary = new UserIncomeSummary();
                    $userIncomeSummary->user_id = $user->id;
                    $userIncomeSummary->transaction_date = $request->step_count_date;
                    $userIncomeSummary->transaction_type = "StepTracker";
                    $userIncomeSummary->withdrawl_status = "approved";
                }
                $userIncomeSummary->credit_amount = $user_tracker->reward_amount;
                $userIncomeSummary->steps =$request->step_count;
                $userIncomeSummary->save();

                if ($user->parent_id) {
                    $firstReferralUser = User::where(['id' => $user->parent_id])->first();

                    $parentIncomeSummary = UserIncomeSummary::where(['user_id' => $firstReferralUser->id])->where(DB::raw('DATE(transaction_date)'), "=", $request->step_count_date)->first();
                    if (is_null($parentIncomeSummary)) {
                        $parentIncomeSummary = new UserIncomeSummary();
                        $parentIncomeSummary->user_id = $firstReferralUser->id;
                        $parentIncomeSummary->transaction_date = $request->step_count_date;
                        $parentIncomeSummary->transaction_type = "Referral";
                        $parentIncomeSummary->referred_user_id = $user->id;
                        $userIncomeSummary->withdrawl_status = "approved";
                    }
                    $parentIncomeSummary->credit_amount = ((int) ($request->step_count / $minSteps)) * $firstLevelRewards;
                    $parentIncomeSummary->save();
                    if ($firstReferralUser->parent_id) {
                        $secondParentIncomeSummary = UserIncomeSummary::where(['user_id' => $firstReferralUser->parent_id])->where(DB::raw('DATE(transaction_date)'), "=", $request->step_count_date)->first();
                        if (is_null($secondParentIncomeSummary)) {
                            $secondParentIncomeSummary = new UserIncomeSummary();
                            $secondParentIncomeSummary->user_id = $firstReferralUser->parent_id;
                            $secondParentIncomeSummary->transaction_date = $request->step_count_date;
                            $secondParentIncomeSummary->transaction_type = "Referral";
                            $parentIncomeSummary->referred_user_id = $user->id;
                            $userIncomeSummary->withdrawl_status = "approved";
                        }
                        $secondParentIncomeSummary->credit_amount = ((int) ($request->step_count / $minSteps)) * $secondLevelRewards;
                        $secondParentIncomeSummary->save();
                    }
                }
            }
            return response()->json(['success' => true, 'data' => $user_tracker], 200);
            }else{
            return response()->json(['success' => false, 'message' => "Invalid Token"], 401);
        }
    }
}
