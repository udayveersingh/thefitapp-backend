<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserIncomeSummary;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTPEmailNotification;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserIncomeSummaryController extends Controller
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
    public function index(Request $request)
    {
        $user = auth()->user();
        if (is_null($user)) {
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }

        $limit = $request->limit ? $request->limit : 10;
        $page = $request->page ? $request->page : 1;
        $offset = (($page - 1) * $limit);
        $orderBy = $request->orderby ? $request->orderby : 'transaction_date';
        $order = $request->order ? $request->order : 'DESC';

        $rewardsQuery = UserIncomeSummary::where('user_id', '=', $user->id);

        if ($request->transaction_date) {
            $rewardsQuery->whereDate('transaction_date', '=', $request->transaction_date);
        }
        if ($request->transaction_type) {
            $rewardsQuery->where('transaction_type', '=', $request->transaction_type);
        }

        $totalRows = $rewardsQuery->count();

        $rewardsQuery->orderBy($orderBy, $order);

        if ($limit > 0) {
            $rewardsQuery->skip($offset)->limit($limit);
        }

        $rewards = $rewardsQuery->get();

        $response = [
            'success' => true,
            'total' => $totalRows,
            'limit' => $limit, // $request->limit
            'page' => $page, // // $request->page
            'data' => $rewards // // $request->page
        ];

        return response()->json($response, 200);
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
        // $validator = Validator::make($request->all(), [
        //     'credit_amount' => 'required',
        //     'debit_amount' => 'required',
        //     'transaction_type' => 'required',
        //     'transaction_date' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->first(), 400);
        // }
        // $user = auth()->user();
        // if ($user) {
        //     $user_income_summary = UserIncomeSummary::create([
        //         'user_id' => $user->id,
        //         'credit_amount' => $request->credit_amount,
        //         'debit_amount' => $request->debit_amount,
        //         'transaction_type' => $request->transaction_type,
        //         'transaction_date' => $request->transaction_date,
        //     ]);
        //     return response()->json(['success' => true, 'data' => $user_income_summary], 200);
        // } else {
        //     return response()->json(['success' => false, 'message' => "Invalid Token"], 401);
        // }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function userEarnings(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        if (is_null($user)) {
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }
        $healthRewards = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'StepTracker')->sum('credit_amount');
        $referralRewards = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'Referral')->sum('credit_amount');
        $response = [
            "success" => true,
            "data" => [
                "health" => $healthRewards,
                "referral" => $referralRewards,
            ],
        ];
        return response()->json($response, 200);
    }

    public function walletBalance()
    {
        $user = auth()->user();
        if (is_null($user)) {
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }
        $healthRewards = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'StepTracker')->sum('credit_amount');
        $referralRewards = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'Referral')->sum('credit_amount');
        $totalBalance = $healthRewards + $referralRewards;
        $response = [
            "success" => true,
            "data" => [
                // "health" => $healthRewards,
                // "referral" => $referralRewards,
                "wallet_balance" => $totalBalance,
            ],
        ];
        return response()->json($response, 200);
    }

    public function withdrawBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'withdrawl_address' => 'required',
            'transaction_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }
        $user = auth()->user();
        if (is_null($user)) {
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }

        if (empty($request->email_otp)) {
            if ($otpcode = $this->generateOtp($user->email)) {
                //TODO: Send Email to customer with OTP Code
                if (env('APP_ENV') != "local") {
                    Mail::to($user->email)->send(new SendOTPEmailNotification($user, $otpcode));
                }
                return response()->json(['success' => true, "message" => "OTP sent successfully", "data" => $user], 200);
            } else {
                return response()->json(['success' => false, "message" => "Failed to send OTP"], 400);
            }
        }

        $verificationCode = UserOtp::where('user_id', $user->id)->where('otp', $request->email_otp)->first();

        $now = Carbon::now();
        if (!$verificationCode) {
            return response()->json(['success' => false, "message" => "Your OTP is not correct"], 400);
        } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
            return response()->json(['success' => false, "message" => "Your OTP has been expired"], 400);
        }
        $user = User::find($user->id);
        if ($user) {
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);

            $user->update([
                'verified'  => 1,
                'email_verified_at'  => Carbon::now(),
            ]);

            $healthRewards = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'StepTracker')->sum('credit_amount');
            $referralRewards = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'Referral')->sum('credit_amount');
            $totalBalance = $healthRewards + $referralRewards;
            if ($totalBalance < $request->amount) {
                return response()->json(['success' => true, "message" => "You should amount request has been less than withdrawl payment."], 400);
            }

            $withdraw_balance = new UserIncomeSummary();
            $withdraw_balance->user_id = $user->id;
            $withdraw_balance->debit_amount = $request->amount;
            $withdraw_balance->transaction_type = "WithDrawl";

            if ($withdraw_balance->save()) {
                // dd($withdraw_balance->user_id);
                $user_profile = Profile::where('user_id', '=', $withdraw_balance->user_id)->first();
                if (is_null($user_profile)) {
                    $user_profile = new Profile();
                } else {
                    $user_profile = Profile::find($user_profile->id);
                }
                $user_profile->user_id = $user->id;
                $user_profile->wallet_address = $request->withdrawl_address;
                $user_profile->save();
                return response()->json(['success' => true, "message" => "Your Payment has been successfully."], 400);
            }
        } else {
            return response()->json(['success' => false, "message" => "Something went wrong. Please try again."], 400);
        }

        // dd($user);
    }


    public function generateOtp($email)
    {
        $user = User::where('email', $email)->first();

        # User Does not Have Any Existing OTP
        $verificationCode = UserOtp::where('user_id', $user->id)->latest()->first();

        $now = Carbon::now();

        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
            return $verificationCode;
        }

        // Create a New OTP
        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => rand(1234, 9999),
            'expire_at' => Carbon::now()->addMinutes(10),
            'created_at' => Carbon::now()
        ]);
    }
}
