<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Fillable properties for mass assignment
    protected $fillable = [
        'C_id',          // Customer ID
        'O_Date_time',   // Order date and time
        'O_Total',       // Total amount
        'O_Address',     // Delivery address
        'O_Description', // Any description of the order
        'created_at',    // Timestamp for creation
        'updated_at',    // Timestamp for updates
    ];

    // Define relationships
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'O_id', 'O_id'); // Assuming O_id is the foreign key in OrderDetail
    }
}
