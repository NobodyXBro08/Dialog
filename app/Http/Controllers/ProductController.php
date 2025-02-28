<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function countByCategory($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            $productCount = $category->products()->count();
            return response()->json(['product_count' => $productCount]);
        } else {
            return response()->json(['message' => 'Category not found'], 404);
        }
    }
}
