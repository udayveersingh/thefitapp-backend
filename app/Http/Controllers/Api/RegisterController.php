<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegisterController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|email',
            'user' => 'required',
            'pass_code' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json([
                'success' => false,
                'message' =>  $error
            ], 400);
        }
        $user = User::where([
            'email' => $request->input('user'),
            'pass_code' => $request->input('pass_code'),
        ])->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')->first();
        if (is_null($user)) {
            $user = User::where([
                'phone' => $request->input('user'),
                'pass_code' => $request->input('pass_code'),
            ])->first();
        }

        if (is_null($user)) {
            return response()->json(["success" => false, "message" => 'No user found.'], 404);
        }
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'data' => $user,
            'access_token' => $token
        ], 201);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $parentId = "";
        if ($request->referral_code) {
            $userId = User::where('referral_code', '=', $request->referral_code)->value('id');
            if (!is_null($userId)) {
                $parentId = $userId;
            } else {
                return response()->json(['success' => true, "message" => "Invalid Referral Code!"], 400);
            }
        }
        $referralCode = GenerateReferralCode();
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'referral_code' => $referralCode,
            'parent_id' => $parentId,
        ]);
        // $token = JWTAuth::fromUser($user);
        // $token = auth::attempt($newUser);

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }



    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'success' => true,
            'data' => auth()->user(),
            'access_token' => $token
            // 'expires_in' => auth()->factory()->getTTL() * 60,
        ], 201);
    }

    public function show($id)
    {
        return response()->json([]);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json([
            'success' => true,
            'message' => 'User logout successfully.'
        ], 201);
    }
}
