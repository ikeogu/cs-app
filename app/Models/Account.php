<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'status', 'acct_number', 'acct_bal','loan_bal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function history(){
        return $this->hasMany(History::class);
    }
    public function contribution(){
        return $this->hasMany(Contribution::class);
    }
}
