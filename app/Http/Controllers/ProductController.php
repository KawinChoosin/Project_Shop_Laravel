<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all categories with related products
        $categories = Category::all();
        $products = Product::all();
        // Pass data to the home view
        return view('home', compact('categories'));
    }

    public function getProductsByCategory(Request $request)
    {
        $categoryName = trim($request->input('category'));
        
        // Initialize categoryId
        $categoryId = null;

        // Check the category name and set the categoryId
        if ($categoryName === 'sports') {
            $categoryId = 1;
        } elseif ($categoryName === 'cloths') {
            $categoryId = 2;
        } elseif ($categoryName === 'electronics') {
            $categoryId = 3;
        } else {
            // Get all products if 'all' is selected
            $products = Product::all();
            return view('home', compact('products', 'categoryName'));
        }

        // Debugging output for categoryId
       

        // If categoryId is set, fetch products for that category
        if ($categoryId) {
            // Get products that belong to the category using CG_id
            $products = Product::where('CG_id', $categoryId)->get();
        } else {
            // If the category doesn't exist, return an empty collection
            $products = collect([]);
        }

        // Pass products and the selected category back to the view
        return view('home', compact('products', 'categoryName'));
    }

    
    
}
