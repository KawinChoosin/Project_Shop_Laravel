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

            ],
            [
                'P_name' => 'Basketball',
                'P_description' => 'Professional basketball for matches',
                'P_quantity' => 15,
                'P_price' => 30,
                'CG_id' => 1,
                'P_img' => 'https://target.scene7.com/is/image/Target/GUEST_bbea9bf3-9ac9-4c79-90bd-d149cf4acef7?wid=1200&hei=1200&qlt=80&fmt=webp',
            ],
            [
                'P_name' => 'Dumbbells',
                'P_description' => 'Set of two 10kg dumbbells',
                'P_quantity' => 10,
                'P_price' => 50,
                'CG_id' => 1,
                'P_img' => 'https://cdn11.bigcommerce.com/s-z6voly6yu7/images/stencil/1280x1280/products/2307/24456/BSTADB545_IMGL9323-2000__11402.1716317975.jpg?c=1?imbypass=on',
            ],
            [
                'P_name' => 'Swimming Goggles',
                'P_description' => 'Anti-fog swimming goggles',
                'P_quantity' => 25,
                'P_price' => 15,
                'CG_id' => 1,
                'P_img' => 'https://www.lomo.co.uk/wp-content/uploads/2022/06/Mirrored-Black-Goggles-1.jpg',
            ],
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
            [
                'P_name' => 'Shorts',
                'P_description' => 'Casual summer shorts',
                'P_quantity' => 30,
                'P_price' => 20,
                'CG_id' => 2,
                'P_img' => 'https://d29c1z66frfv6c.cloudfront.net/pub/media/catalog/product/large/a5195a2eb7582ccf1f2e5e2c5d8e767575edc13d_xxl-1.jpg',
            ],
            [
                'P_name' => 'Scarf',
                'P_description' => 'Warm winter scarf',
                'P_quantity' => 20,
                'P_price' => 18,
                'CG_id' => 2,
                'P_img' => 'https://media.parttwo.com/images/fiery-red-scarf.jpg?i=AGyD0Rfo2wg/271881&mw=610',
            ],
            [
                'P_name' => 'Cap',
                'P_description' => 'Stylish baseball cap',
                'P_quantity' => 50,
                'P_price' => 10,
                'CG_id' => 2,
                'P_img' => 'https://eu-images.contentstack.com/v3/assets/blt7dcd2cfbc90d45de/blt74086f9b89cb9448/64819127131ecf31edf40d04/28716.jpg?format=pjpg&auto=webp&quality=75%2C90&width=640',
            ]
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
            [
                'P_name' => 'Smartwatch',
                'P_description' => 'Smartwatch with fitness tracking',
                'P_quantity' => 20,
                'P_price' => 200,
                'CG_id' => 3,
                'P_img' => 'https://caseduck.com/wp-content/uploads/2024/05/%E7%94%BB%E6%9D%BF-1.jpg',
            ],
            [
                'P_name' => 'Monitor',
                'P_description' => '4K computer monitor',
                'P_quantity' => 10,
                'P_price' => 300.0,
                'CG_id' => 3,
                'P_img' => 'https://static-ecapac.acer.com/media/catalog/product/a/c/acer_monitor_ek0-series_ek240y_ek220q_wp-01_3_um.we0st.302.jpg?optimize=high&bg-color=255,255,255&fit=bounds&height=500&width=500&canvas=500:500'
            ],
            [
                'P_name' => 'Printer',
                'P_description' => 'Wireless printer',
                'P_quantity' => 12,
                'P_price' => 150.0,
                'CG_id' => 3,
                'P_img' => 'https://mediaserver.goepson.com/ImConvServlet/imconv/63d65bfb325dadd89dd438c9482febd02112c15d/1200Wx1200H?use=banner&hybrisId=B2C&assetDescr=L5590-%282%29'
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