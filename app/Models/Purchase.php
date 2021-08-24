<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['reference', 'amount', 'email', 'bank', 'title', 'product_id', 'status', 'paid_at', 'card_type', 'fees'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}