<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['C_name', 'C_password', 'C_email'];

    protected $primaryKey = 'C_id'; // Add this line to specify the custom primary key

    public function addresses()
    {
        return $this->hasMany(Address::class, 'C_id');
    }
}

