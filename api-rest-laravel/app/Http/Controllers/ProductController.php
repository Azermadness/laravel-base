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
        $products = Product::where('nom' , '!=', '');
        if (isset($request->id) && $request->id != '') {
            $products = $products->where('id', $request->id);
        }

        $products = $products->get();

        return response()->json([
            'status' => true,
            'message' => 'products listed successfully',
            'data' => $products
        ], 200);
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
            'description' => isset($request->description) ? $request->description : '',
            'prix' => $request->prix,
        );

        $product = Product::create($inputData);

        return response()->json([
            'status' => true,
            'message' => 'product added successfully',
            'data' => $product
        ], 200);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $product = Product::find($request->id);

        $product->nom = $request->nom;
        $product->description = isset($request->description) ? $request->description : '';
        $product->prix = $request->prix;
    
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'product edited successfully',
            'data' => $product
        ], 200);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'data' => $validator->errors()
            ], 422);
        }

        $product = Product::find($request->id);

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'product removed successfully',
            'data' => $product
        ], 200);
    }
}
