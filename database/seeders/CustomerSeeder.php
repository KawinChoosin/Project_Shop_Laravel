<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Insert some dummy customers
        $customers = [
            [
                'C_name' => 'John Doe',
                'C_password' => bcrypt('password'), // Hash the password
                'C_email' => 'john@example.com',
       
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'C_name' => 'Jane Smith',
                'C_password' => bcrypt('password'), // Hash the password
                'C_email' => 'jane@example.com',
            
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
