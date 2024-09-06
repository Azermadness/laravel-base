<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        return response()->json(Product::all());
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:products,nom|max:20',
            'prix' => 'required|decimal:0,2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $inputData = array(
            'nom' => $request->nom,
            'description' => isset($request->nom) ? $request->nom : '',
            'prix' => $request->prix,
        );

        $product = Product::create($inputData);

        return response()->json([
            'status' => true,
            'message' => 'product added successfully',
            'data' => $product
        ], 200);
    }
}
