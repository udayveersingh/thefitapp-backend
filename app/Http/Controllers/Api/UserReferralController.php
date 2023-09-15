<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserIncomeSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserReferralController extends Controller
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
        $total_referral_earns = UserIncomeSummary::where('user_id','=',$user->id)->where('transaction_type','=','Referral')->sum('credit_amount');
        // dd($request->all());
        $limit = $request->limit ? $request->limit : 10;
        $page = $request->page ? $request->page : 1;
        $offset = (($page - 1) * $limit);
        $orderBy = $request->orderby ? $request->orderby : 'transaction_date';
        $order = $request->order ? $request->order : 'DESC';

        $referralFriendsQuery = DB::table('user_income_summaries')
        ->select(DB::raw('DATE_FORMAT(user_income_summaries.transaction_date,"%m-%d-%Y") as date'),'user_income_summaries.credit_amount','users.name')
        ->join('users', 'users.id','=','user_income_summaries.referred_user_id')->where('user_income_summaries.user_id','=',$user->id);
        // ->where('user_income_summaries.transaction_type','=','Referral');
    // ->get();
        if ($request->transaction_date) {
            $referralFriendsQuery->whereDate('transaction_date', '=', $request->transaction_date);
        }

        $totalRows = $referralFriendsQuery->count();
        $referralFriendsQuery->orderBy($orderBy, $order);

        if ($limit > 0) {
            $referralFriendsQuery->skip($offset)->limit($limit);
        }
        $referral_users = $referralFriendsQuery->get();


        $response = [
            'success' => true,
            'total_referral_earns' => $total_referral_earns,
            'referral_code' => $user->referral_code,
            'total' => $totalRows,
            'limit' => $limit, // $request->limit
            'page' => $page, // // $request->page
            'data' => $referral_users,
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
}
