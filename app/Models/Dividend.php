<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dividend extends Model
{
    use HasFactory;
    protected $fillable =['company',
     'announced',
     'interim',
     'final_div',
      'total_div',
      'bonus',
      'closure_date',
      'agm',
      'payment_d',
      'quali_date'];
}