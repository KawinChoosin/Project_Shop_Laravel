<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'CG_id';

    protected $fillable = [
        'CG_name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'CG_id', 'CG_id');
    }


}
