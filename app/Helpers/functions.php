<?php

use App\Models\Setting;
use App\Models\User;

if(!function_exists('get_image_absolute_path')){
    function get_images_absolute_path($object = []){
        if(empty($object))
            return false;

        if(file_exists(public_path().'/storage/images/'.$object['profile_pic'])){
            $object['profile_pic'] = asset('storage/images/'.$object['profile_pic']);
        }        
        return $object;
    }
}


if(!function_exists('getSettings')){
    function getSettings()
    {
         return Setting::pluck('value', 'key');
    }
}

if(!function_exists('GenerateReferralCode')){
function GenerateReferralCode() {
    $randCode  = (string)mt_rand(1000,99999);
    $randChar  = rand(65,90);
    $randInx   = rand(0,3);
    $randCode[$randInx] = chr($randChar);

    $user = User::where('referral_code', '=', $randCode)->first();
    if(!is_null($user)){
        return GenerateReferralCode();
    }else{
        return $randCode;
    }
  }
}