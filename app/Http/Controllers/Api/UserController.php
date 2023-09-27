<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
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
        } else {
            $user = User::with('profile')->find($user->id)->toArray();
            if (isset($user['profile'])) {
                $user['profile'] = get_images_absolute_path($user['profile']);
            }
            return response()->json(['success' => true, 'data' => $user], 200);
        }
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
        $user = user::find(auth()->user()->id);
        if ($user) {

            if ($request->input('pass_code')) {
                $user->pass_code = $request->input('pass_code');
            }
            if ($request->input('name')) {
                $user->name = $request->input('name');
            }
            if ($request->input('phone')) {
                $user->phone = $request->input('phone');
            }

            $user->save();

            if ($request->hasFile('profile_pic')) {
                $user_profile = Profile::where('user_id', '=', $user->id)->first();
                if (is_null($user_profile)) {
                    $user_profile = new Profile();
                    $user_profile->user_id = $user->id;
                }

                $profile_pic = $user->id . "-" . time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(public_path('storage/images/'), $profile_pic);

                $user_profile->profile_pic =  $profile_pic;
                $user_profile->save();
            }

            $user = User::with('profile')->find($user->id)->toArray();
            if (isset($user['profile'])) {
                $user['profile'] = get_images_absolute_path($user['profile']);
            }
            return response()->json(['success' => true, 'user' => $user], 200);
        } else {
            return response()->json(['success' => false, 'message' => "Unauthorized Error!"], 401);
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
    public function update(Request $request)
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
