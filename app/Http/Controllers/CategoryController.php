<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Obtener todas las categorías
    public function index()
    {
        return response()->json(Category::all());
    }

    // Obtener una categoría por su ID
    public function show($id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'Invalid category ID'], 400);
        }

        $category = Category::find($id);
        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['message' => 'Category with the specified ID not found'], 404);
        }
    }
}
