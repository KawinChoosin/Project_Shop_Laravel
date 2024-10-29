<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'CA_id';  // Set primary key

    // Define the relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'P_id', 'P_id');  // Link to the Product model using P_id
    }
}
