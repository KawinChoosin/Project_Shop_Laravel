<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    // Fillable properties for mass assignment
    protected $fillable = [
        'O_id',        // Foreign key to Order
        'P_id',        // Product ID
        'OD_quantity', // Quantity of the product
        'OD_price',    // Price of the product
        'created_at',  // Timestamp for creation
        'updated_at',  // Timestamp for updates
    ];

    // Define relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'O_id', 'O_id'); // Assuming O_id is the foreign key in Order
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'P_id', 'P_id'); // Assuming P_id relates to a Product model
    }
}
