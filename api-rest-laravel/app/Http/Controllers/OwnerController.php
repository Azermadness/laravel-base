<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Http\Resources\OwnerResource;

class OwnerController extends Controller
{
    public function index(Request $request)
    {
        $products = Owner::where('nom' , '!=', '');
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

    public function owner_home(Request $request, string $id) {
        $owners = Owner::join('homes', 'owners.id', '=', 'homes.owner_id')->where('owners.id','=',$id)->get();

        return response()->json([
            'status' => true,
            'message' => 'homes listed successfully',
            'data' => $owners
        ], 200);
    }
}
