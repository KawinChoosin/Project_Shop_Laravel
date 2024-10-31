<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Insert categories
        $categories = [
            ['CG_name' => 'Sport'],
            ['CG_name' => 'Cloth'],
            ['CG_name' => 'Electronic']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Sport category products
        $sportProducts = [
            [
                'P_name' => 'Bike',
                'P_description' => 'Green bike for outdoor sports',
                'P_quantity' => 5,
                'P_price' => 100,
                'CG_id' => 1,
                'P_img' => 'https://i5.walmartimages.com/seo/Hyper-Bicycle-26-Men-s-Havoc-Mountain-Bike-Black_598552b8-96fc-4e95-9fbd-10b48c25f76a.ab643dd657a02399f80cfcc2adcc9b22.jpeg',
            ],
            [
                'P_name' => 'Football',
                'P_description' => 'Standard football for matches',
                'P_quantity' => 10,
                'P_price' => 25,
                'CG_id' => 1,
                'P_img' => 'https://th.bing.com/th/id/R.2d77bfb399b7324beb3ac6c9debe3df8?rik=4VW7P1t7M%2b%2foEQ&pid=ImgRaw&r=0',
            ],
            [
                'P_name' => 'Tennis Racket',
                'P_description' => 'Lightweight tennis racket',
                'P_quantity' => 15,
                'P_price' => 75,
                'CG_id' => 1,
                'P_img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHOCBcsDToYJSe4n7bn7deIO16auJqluxpSg&s',
            ]
        ];

        // Cloth category products
        $clothProducts = [
            [
                'P_name' => 'T-Shirt',
                'P_description' => 'Comfortable cotton t-shirt',
                'P_quantity' => 20,
                'P_price' => 15.0,
                'CG_id' => 2,
                'P_img' => 'https://isto.pt/cdn/shop/files/Heavyweight_Black_ef459afb-ff7a-4f9a-b278-9e9621335444.webp?v=1710414950',
            ],
            [
                'P_name' => 'Jeans',
                'P_description' => 'Blue denim jeans',
                'P_quantity' => 30,
                'P_price' => 40.0,
                'CG_id' => 2,
                'P_img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPvHcOxrwkYyvOw-C1NWvRgZ8nd-ib-Y3H_Q&s',
            ],
            [
                'P_name' => 'Jacket',
                'P_description' => 'Warm winter jacket',
                'P_quantity' => 12,
                'P_price' => 120.0,
                'CG_id' => 2,
                'P_img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIPgD0roIatOa0eiPkMPemhSbYU20lojcJqQ&s',
            ],
        ];

        // Electronic category products
        $elecProducts = [
            [
                'P_name' => 'Laptop',
                'P_description' => 'High-performance laptop',
                'P_quantity' => 8,
                'P_price' => 800.0,
                'CG_id' => 3,
                'P_img' => 'https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RW16TLT?ver=99ac&q=90&m=6&h=705&w=1253&b=%23FFFFFFFF&f=jpg&o=f&p=140&aim=true',
            ],
            [
                'P_name' => 'Smartphone',
                'P_description' => 'Latest model smartphone',
                'P_quantity' => 25,
                'P_price' => 600.0,
                'CG_id' => 3,
                'P_img' => 'https://m.media-amazon.com/images/I/61nzbNdA7hL.jpg',
            ],
            [
                'P_name' => 'Headphones',
                'P_description' => 'Noise-cancelling headphones',
                'P_quantity' => 50,
                'P_price' => 150.0,
                'CG_id' => 3,
                'P_img' => 'https://sony.scene7.com/is/image/sonyglobalsolutions/wh-ch520_Primary_image?$categorypdpnav$&fmt=png-alpha',
            ],
        ];

        // Create products for each category
        foreach ($sportProducts as $product) {
            Product::create($product);
        }

        foreach ($clothProducts as $product) {
            Product::create($product);
        }

        foreach ($elecProducts as $product) {
            Product::create($product);
        }
    }
}
