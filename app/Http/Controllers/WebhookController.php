<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handleRequest(Request $request)
    {
        // Obtener la consulta de Dialogflow
        $queryText = $request->input('queryResult.queryText');
        $intentName = $request->input('queryResult.intent.displayName');

        // Lógica de negocios según el Intent recibido
        switch ($intentName) {
            case 'GetCategoryProductsCount':
                $categoryName = $request->input('queryResult.parameters.category');
                $category = Category::where('name', $categoryName)->first();
                if ($category) {
                    $productCount = $category->products()->count();
                    return response()->json([
                        'fulfillmentText' => "La categoría '$categoryName' tiene $productCount productos."
                    ]);
                } else {
                    return response()->json([
                        'fulfillmentText' => "No se encontró la categoría '$categoryName'."
                    ]);
                }

            default:
                // Respuesta predeterminada si el Intent no es reconocido
                return response()->json([
                    'fulfillmentText' => "Conexión establecida correctamente. No se ha implementado lógica para este intent."
                ]);
        }
    }
}
