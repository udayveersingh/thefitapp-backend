<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIncomeSummary extends Model
{
  protected $fillable = [
    'user_id', 'credit_amount', 'debit_amount', 'transaction_type', 'transaction_date', 'steps', 'referred_user_id'
  ];
  
  public function users()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
