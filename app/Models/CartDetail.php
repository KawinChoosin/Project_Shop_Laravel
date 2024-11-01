<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $table = 'cart_details';
    protected $primaryKey = 'CA_id';
    protected $fillable = [
        'C_id', 'P_id', 'CA_quantity', 'CA_Price'
    ];
    
    // Define the relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'P_id', 'P_id');  // Link to the Product model using P_id
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'C_id', 'C_id');
    }
}