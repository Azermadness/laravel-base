<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bird;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\Validator;

class BirdController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Bird::all());
    }

    public function minsize(Request $request)
    {
        $birds = Bird::where('taille_min_cm', '=', 12)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200);
    }

    public function minsizeforest(Request $request)
    {

        $birds = Bird::where('taille_min_cm', '=', 12)
            ->where('habitat', '=', 'Forêts, jardins')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200); //code 200 s'est bien passé
    }

    public function firstletterM(Request $request)
    {

        $birds = Bird::where('nom_commun', 'like', 'M%')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200); //code 200 s'est bien passé
    }

    public function firstletterMComplex(Request $request)
    {

        $birds = Bird::where('nom_commun', 'like', 'M%')
            ->orWhere('nom_scientifique', 'like', 'M%')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200); //code 200 s'est bien passé
    }

    public function jardins(Request $request)
    {

        $birds = Bird::where('habitat', 'like', '%jardins%')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200); //code 200 s'est bien passé
    }

    public function poids(Request $request)
    {

        $birds = Bird::where('poids_min_g', '<=', 15)
            ->where('poids_max_g', '>=', 15)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200); //code 200 s'est bien passé
    }

    public function chiante(Request $request)
    {

        $birds = Bird::where('couleur', 'like', 'Brun%')
            ->where('taille_min_cm', '>=', 12)
            ->where('nom_commun', 'like', 'M%')
            ->where('poids_min_g', '<=', 15)
            ->where('poids_max_g', '>=', 15)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200); //code 200 s'est bien passé
    }

    public function sortalphabet(Request $request)
    {

        $birds = Bird::orderBy('nom_commun', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Product List Successfully',
            'data' => $birds
        ], 200); //code 200 s'est bien passé
    }
}