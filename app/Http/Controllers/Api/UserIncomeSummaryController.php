<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserIncomeSummary;
use App\Models\UserTracker;
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

        $rewardsQuery = UserIncomeSummary::where('user_id', '=', $user->id)
                                           ->where('transaction_type','=','StepTracker');

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
        $totalBalance = UserIncomeSummary::where('user_id', '=', $user->id)->sum('credit_amount');
        $profile = Profile::where('user_id', '=', $user->id)->first();
        if(!empty($profile)){
            $kyc_status = (!empty($profile->kyc_status) && ($profile->kyc_status==1))?'verified':'un-verified';
            $wallet_address = $profile->wallet_address;
        }else{
            $kyc_status = 'un-verified';
            $wallet_address = '';
        }
        $response = [
            "success" => true,
            "data" => [
                // "health" => $healthRewards,
                // "referral" => $referralRewards,
                "wallet_balance" => round($totalBalance,2),
                "wallet_address" => $wallet_address,
                "kyc_status" => $kyc_status
            ],
        ];
        return response()->json($response, 200);
    }

    public function withdrawBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
         //   'withdrawl_address' => 'required',
            'amount_to_pox' => 'required',
            // 'transaction_date' => 'required',
            // 'email_otp' => 'required',
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

        $check_withdrawl_request = UserIncomeSummary::where('user_id', '=', $user->id)->where('withdrawl_status', '=', 'pending')->first();
        if (!empty($check_withdrawl_request) && $check_withdrawl_request->withdrawl_status == 'pending') {
            return response()->json(['success' => false, "message" => "Your previous withdrawal request is under process. You can place next withdrawal after processing previous request from our side."], 400);
        }

        $totalBalance = UserIncomeSummary::where('user_id', '=', $user->id)->sum('credit_amount');
        if ($totalBalance < $request->amount) {
            return response()->json(['success' => false, "message" => "Your wallet balance is less than the requested amount."], 400);
        }
  
        $current_date = date('Y-m-d');
        $withdraw_balance = new UserIncomeSummary();
        $withdraw_balance->user_id = $user->id;
        $withdraw_balance->debit_amount = $request->amount;
        $withdraw_balance->pox_amount =  $request->amount_to_pox;
        $withdraw_balance->transaction_type = "WithDrawl";
        $withdraw_balance->withdrawl_status = "pending";
        $withdraw_balance->transaction_date = $current_date;
  
        if ($withdraw_balance->save()) {
            // dd($withdraw_balance->user_id);
            return response()->json(['success' => true, "message" => "We recieved your withdrawal request! We will process soon after reviewing your account."], 200);
        }
    }

    public function withDrawlList(Request $request)
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
        $withdrawlQuery = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'WithDrawl')->where('withdrawl_status', '=', 'approved');
        if ($request->transaction_date) {
            $withdrawlQuery->whereDate('transaction_date', '=', $request->transaction_date);
        }
        $totalRows = $withdrawlQuery->count();
        $withdrawlQuery->orderBy($orderBy, $order);
        if ($limit > 0) {
            $withdrawlQuery->skip($offset)->limit($limit);
        }

        $user_withdrawl_list = $withdrawlQuery->get();

        $response = [
            'success' => true,
            'total' => $totalRows,
            'limit' => $limit, // $request->limit
            'page' => $page, // // $request->page
            'data' => $user_withdrawl_list // // $request->page
        ];
        return response()->json($response, 200);
    }


    public function userDailyGoals()
    {
        $user = auth()->user();
        if (is_null($user)) {
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }
        $today_date = \Carbon\Carbon::today();
        $last_date = \Carbon\Carbon::today()->subDays(7);
      //  $user_daily_goals = UserIncomeSummary::where('user_id', '=', $user->id)->where('transaction_type', '=', 'StepTracker')->where('transaction_date', '>=', $last_date)->get();
        $daily_goal_data = [];
        $exist_daily_goal = [];
        $user_daily_goals = UserTracker::where('user_id', '=', $user->id)
                                        ->where('step_count_date', '>=', $last_date)
                                        ->select('id','user_id','step_count_date','step_count','step_target')
                                        ->get();
     //   dd($user_daily_goals);
        foreach($user_daily_goals as $daily_goal){
            $dayname = date('D', strtotime($daily_goal['step_count_date']));
            $daily_goal['day'] = $dayname;
            $step_perc = floor( (( $daily_goal['step_count'] / $daily_goal['step_target'] ) * 100));
            if($step_perc >= 100)
            $step_perc = 100;
            $daily_goal['step_count_perc'] = $step_perc;
            $exist_daily_goal[$daily_goal['step_count_date']] = $daily_goal;
        }

        for($i = $today_date; $i > $last_date; $i->modify('-1 day')){
            $current_date = date('Y-m-d',strtotime($i));
            if(array_key_exists($current_date,$exist_daily_goal)){
                $daily_goal_data[] = $exist_daily_goal[$current_date];
            }else{
                $daily_goal_data[] =[
                    'day' => date('D', strtotime($i)),
                    'step_count_date' => date('Y-m-d',strtotime($i)),
                    'step_count' => 0,
                    'step_count_perc' => 0,
                ];
            }
            
        }
        
        $response = [
            "success" => true,
            "data" => [
                "daily_goals"   => $daily_goal_data,
            ],
        ];
        return response()->json($response, 200);
    }

    /* Public function coin converter */

    public function coinConverter(Request $request){
        
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $usdt_amt = $request->amount;

        // curl call 
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.coingecko.com/api/v3/simple/price?ids=pollux-coin&vs_currencies=usd',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                ': '.env('COIN_GEKO_API_KEY')
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if(!empty($response)){
            $arr_data = json_decode($response, true);
            $one_pox_usd = $arr_data['pollux-coin']['usd'];
            $user_pox = round($usdt_amt / $one_pox_usd,2);
            $coin_data = [
                "pox_usd"=>$user_pox
            ];
            return response()->json([
                'success' => true,
                'data' => $coin_data
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Coin conversion api issue! Try later.'
            ], 400);
        }
        
    }

    public function verifyProfile(Request $request){


        $user = auth()->user();
        if (is_null($user)) {
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }

        $validator = Validator::make($request->all(), [
            'wallet_address' => 'required',
            'kyc_doc_aadhar' => 'required',
            'kyc_doc_pan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        
        $user_profile = Profile::where('user_id', '=', $user->id)->first();
        if (is_null($user_profile)) {
            return response()->json([
                'success' => false,
                'message' => 'First update your profile to proceed with KYC'
            ], 400);
        } else {

            $kyc_doc_pan= null;
            if($request->hasFile('kyc_doc_pan')){
                $kyc_doc_pan = 'pan-'. time() . '.' . $request->kyc_doc_pan->extension();
                $request->kyc_doc_pan->move(public_path('storage/user/'.$user->id.'/'),  $kyc_doc_pan);
            }

            $kyc_doc_aadhar= null;
            if($request->hasFile('kyc_doc_aadhar')){
                $kyc_doc_aadhar = 'aadhar-'. time() . '.' .  $request->kyc_doc_aadhar->extension();
                $request->kyc_doc_aadhar->move(public_path('storage/user/'.$user->id.'/'),  $kyc_doc_aadhar);
            }

            $user_profile->user_id = $user->id;
            $user_profile->kyc_doc_1 = $kyc_doc_pan;
            $user_profile->kyc_doc_2 = $kyc_doc_aadhar;
            $user_profile->wallet_address = $request->wallet_address;
            $user_profile->kyc_status = 0;
            $user_profile->kyc_submit_date = date('Y-m-d h:i:s');
            
            if($user_profile->save()){
                return response()->json([
                    'success' => true, 
                    'message' => 'We recieved your documents. You will be notify within 24 hours about your KYC status!'
                ], 200);
            }else{
                return response()->json([
                    'success' => false, 
                    'message' => 'Something went worng.Try again later!'
                ], 400);
            }
            

        }

    }

}
