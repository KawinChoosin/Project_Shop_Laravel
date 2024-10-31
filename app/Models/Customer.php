<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'customers';
    protected $primaryKey = 'C_id';


    protected $fillable = ['name', 'password', 'email'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'C_id'; // Add this line to specify the custom primary key

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'C_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'C_id'); // Assuming O_id is the foreign key in OrderDetail
    }
}

