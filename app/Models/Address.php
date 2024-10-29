<?php

// app/Models/Address.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $primaryKey = 'A_id';

    protected $fillable = [
        'A_address_line1',
        'A_city',
        'A_state',
        'A_postal_code',
        'A_country',
        'A_is_default',
        'C_id',
        'A_name',
        'A_phone_number',
    ];
}
