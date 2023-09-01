<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRefferal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function index()
    {
        return response()->json(['success' => 'true'], 200);
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
        $validator = Validator::make($request->all(), [
            'parent_id' => 'required',
            'referral_date' => 'required',
            'referral_amount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = auth()->user();
        if ($user) {
            $user_Referral = UserRefferal::create([
                'user_id' => $user->id,
                'parent_id' => $request->parent_id,
                'referral_date' => $request->referral_date,
                'referral_amount' => $request->referral_amount,
            ]);
            return response()->json(['success' => true, 'data' => $user_Referral], 200);
        } else {
            return response()->json(['success' => false, 'message' => "Invalid Token"], 401);
        }
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
}
