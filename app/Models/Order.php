<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'order_number',
        'status',
        'subtotal',
        'tax',
        'total',
        'order_date',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'order_date' => 'datetime',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function orderLines(){
        return $this->hasMany(OrderLine::class);
    }

    public function scopeStatus($query, $status){
        return $query->where('status', $status);
    }

    public function getFormattedTotalAttribute(){
        return '$' . number_format($this->total, 2);
    }
 
    public static function generateOrderNumber(){
        $date = now()->format('Ymd');
        $lastOrder = static::where('order_number', 'like', "SO-{$date}-%")
                        ->orderBy('order_number', 'desc')
                        ->first();

        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->order_number, -4);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return "SO-{$date}-{$nextNumber}";
    }
}
