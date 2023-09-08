<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserIncomeSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        if(is_null($user)){
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }

        $limit = $request->limit ? $request->limit : 10;
        $page = $request->page ? $request->page : 1;
        $offset = (($page-1)* $limit);
        $orderBy = $request->orderby ? $request->orderby : 'transaction_date';
        $order = $request->order ? $request->order : 'DESC';

        $rewardsQuery = UserIncomeSummary::where('user_id','=',$user->id);

        if($request->transaction_date){
            $rewardsQuery->whereDate('transaction_date','=',$request->transaction_date);
        }
        if($request->transaction_type){
            $rewardsQuery->where('transaction_type','=',$request->transaction_type);
        }

        $totalRows = $rewardsQuery->count();

        $rewardsQuery->orderBy($orderBy, $order);

        if($limit > 0){
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
        if(is_null($user)){
            return response()->json(['success' => false, 'message' => "Invalid Request"], 401);
        }
        $healthRewards = UserIncomeSummary::where('user_id','=',$user->id)->where('transaction_type','=','StepTracker')->sum('credit_amount');
        $referralRewards = UserIncomeSummary::where('user_id','=',$user->id)->where('transaction_type','=','Referral')->sum('credit_amount');
        $response = [
            "success" => true,
            "data" => [
                "health" => $healthRewards,
                "referral" => $referralRewards,
            ],
        ];
        return response()->json($response, 200);
    }
}
