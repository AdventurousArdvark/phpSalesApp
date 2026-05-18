<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function scopeSearch($query, $term){
        return $query->where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%");
    }

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }
}
