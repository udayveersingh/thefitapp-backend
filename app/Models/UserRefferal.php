<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRefferal extends Model
{
       protected $fillable = ['user_id','parent_id','referral_date','referral_amount'];
}
