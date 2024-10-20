<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart_details';
    protected $primaryKey = 'CA_id';
    protected $fillable = [
        'C_id', 'P_id', 'CA_quantity', 'CA_Price'
    ];

    // A cart belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'C_id');
    }

    // A cart belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'P_id');
    }
}
