<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'P_id';

    protected $fillable = [
        'P_name', 'P_description', 'P_quantity', 'P_price', 'P_img', 'CG_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CG_id', 'CG_id');
    }
}
