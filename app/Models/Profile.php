<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id','profile_pic','wallet_address','kyc_doc_1','kyc_doc_2','kyc_status'    
    ];
}
