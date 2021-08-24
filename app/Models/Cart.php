<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id,  $qty = 0)
    {
        $storedItem = ['qty' => $qty, 'price' => ($item->price / 100), 'item' => $item];
        $qtyPerItem = $storedItem['qty'];
        $currentPrice = ($storedItem['price']);
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->items[$id]['qty'] += $storedItem['qty'];
                $storedItem = $this->items[$id];
            } else {
                $number = uniqid();
                $id = $number;
            }
        }
        $storedItem['price'] = ($item->price / 100) * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        //$this->totalQty += $this->items[$id]['qty'];
        $this->totalQty += $qtyPerItem;
        $this->totalPrice +=  $currentPrice * $qtyPerItem;
    }

    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;

        $this->items[$id]['price'] -= $this->items[$id]['item']['price'] / 100;
        if ($this->totalQty <= 0) {
            $this->totalQty = 0;
        } else {
            $this->totalQty--;
        }
        if ($this->totalPrice <= 0) {
            $this->totalPrice = 0;
        } else {
            $this->totalPrice -= $this->items[$id]['item']['price'] / 100;
        }
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }
    public function addByOne($id)
    {
        $this->items[$id]['qty']++;

        $this->items[$id]['price'] += $this->items[$id]['item']['price'] / 100;
        if ($this->totalQty <= 0) {
            $this->totalQty = 0;
        } else {
            $this->totalQty++;
        }
        if ($this->totalPrice <= 0) {
            $this->totalPrice = 0;
        } else {
            $this->totalPrice += $this->items[$id]['item']['price'] / 100;
        }
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function removeItem($id)
    {
        if (array_key_exists($id, $this->items)) {
            $itemsQty = $this->items[$id]['qty'];
            $itemsPrice = $this->items[$id]['price'];

            $this->totalQty -= $itemsQty;
            $this->totalPrice -= $itemsPrice;
            unset($this->items[$id]);
        }
    }

}
