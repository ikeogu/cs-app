<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'amount_range','status','intrest','duration'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function memberloan(){
        return $this->hasMany(MemberLoan::class);
    }
}
