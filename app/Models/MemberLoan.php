<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberLoan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'reciept','paid_via','loan_id','status','reason','code','gcode','payback','duration','intrest'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan(){
        return $this->belongsTo(Loan::class);
    }

    public function getGrantor($code){
        return User::where('code',$code)->first()->name ?? '';
    }
}
