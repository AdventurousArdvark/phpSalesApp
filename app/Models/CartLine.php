<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartLine extends Model
{
    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity',
    ];
 
    protected $casts = [
        'quantity' => 'integer',
    ];
 
    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function getLineTotalAttribute(){
        return $this->item->price * $this->quantity;
    }

    public function getFormattedLineTotalAttribute(){
        return '$' . number_format($this->line_total, 2);
    }
}
