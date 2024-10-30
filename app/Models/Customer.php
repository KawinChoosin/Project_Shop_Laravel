<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'customers';
    protected $primaryKey = 'C_id';
    protected $fillable = [
        'C_name', 'C_password', 'C_email', 'C_Address'
    ];

    // A customer can have many cart items
    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'C_id');
    }

    // A customer can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'C_id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'C_id');
    }
}

