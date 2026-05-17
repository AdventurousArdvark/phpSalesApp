<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cartLines(){
        return $this->hasMany(CartLine::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class, 'cart_lines')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function getSubtotalAttribute(){
        return $this->cartLines->sum(function ($line) {
            return $line->item->price * $line->quantity;
        });
    }

    public function getFormattedSubtotalAttribute(){
        return '$' . number_format($this->subtotal, 2);
    }
}
