<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['account_id','amount','acct_bal', 'user_id','status','can_pay' ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}