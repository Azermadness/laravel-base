<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Http\Resources\HomeResource;
use App\Http\Resources\HomeCollection;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // return HomeResource::collection(Home::all());
        $homes = Home::all();
        return new HomeCollection($homes);
    }
    public function store(Request $request)
    {
        $home = Home::create($request->all());
        return new HomeResource($home);
    }
    public function show($id)
    {
        $home = Home::findOrFail($id);
        return new HomeResource($home);
    }
    public function update(Request $request, $id)
    {
        $home = Home::findOrFail($id);
        $home->update($request->all());
        return new HomeResource($home);
    }
    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();
        return response()->json(null, 204);
    }
}