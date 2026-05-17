<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'unit_price',
        'line_total',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'line_total' => 'decimal:2',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function getFormattedUnitPriceAttribute(){
        return '$' . number_format($this->unit_price, 2);
    }
 
    public function getFormattedLineTotalAttribute(){
        return '$' . number_format($this->line_total, 2);
    }
}
