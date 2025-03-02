<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Obtener todos los productos
    public function index()
    {
        return response()->json(Product::all());
    }

    // Obtener un producto por su ID
    public function show($id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'Invalid product ID'], 400);
        }

        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product with the specified ID not found'], 404);
        }
    }

    // Obtener la cantidad de productos por categoría
    public function countByCategory($categoryId)
    {
        if (!is_numeric($categoryId)) {
            return response()->json(['message' => 'Invalid category ID'], 400);
        }

        $category = Category::find($categoryId);
        if ($category) {
            $productCount = $category->products()->count();
            return response()->json(['product_count' => $productCount]);
        } else {
            return response()->json(['message' => 'Category with the specified ID not found'], 404);
        }
    }
}
