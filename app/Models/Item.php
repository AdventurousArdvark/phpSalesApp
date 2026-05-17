<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'quantity',
    ];

    protected $casts = [
        'price' => 'deciaml:2',
        'quantity' => 'integer',
    ];

    public function cartLines(){
        return $this->hasMany(CartLine::class);
    }

    public function orderLines(){
        return $this->hasMany(OrderLine::class);
    }

    public function scopeSearch($query, $term){
        return $query->where('name', 'like', "%{term}%")
                    ->orWhere('sku', 'like', "%{term}%"); 
    }

    public function getFormattedPriceAttribute(){
        return '$' . number_format($this->price, 2);
    }
}
