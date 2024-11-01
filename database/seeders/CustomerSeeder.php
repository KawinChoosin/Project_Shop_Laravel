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
                'name' => 'John Doe',
                'password' => bcrypt('password'), // Hash the password
                'email' => 'john@example.com',
       
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'password' => bcrypt('password'), // Hash the password
                'email' => 'jane@example.com',
            
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
