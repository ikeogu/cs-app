<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'password',
        'phone',
        'can_pay',
        'salary',
        'status',
        'isAdmin',
        'code',
        'keep_track',
        'shares',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function account(){
        return $this->hasOne(Account::class);
    }
    public function contribution()
    {
        return $this->hasMany(Contribution::class);
    }

    public static function mydet($id){
        return Account::where('user_id',$id)->first();
    }

    public function withdraw(){
        return $this->hasMany(Withdrawal::class);
    }
    public function loan(){
        return $this->hasOne(Loan::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function deduction(){
        return $this->hasMany(Deduction::class);
    }

}
