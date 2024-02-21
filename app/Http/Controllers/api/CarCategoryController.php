<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\CarCategory;

class CarCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarCategory::orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CarCategory::create($request->all());

        return response()->json([
            'message' => 'Car category created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return CarCategory::findOrFail($id);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $carCategory = CarCategory::findOrFail($id);
        $carCategory->update($request->all());

        return response()->json([
            'message' => 'Car category updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carCategory = CarCategory::findOrFail($id);
        $carCategory->delete();
        return response()->json([
            'message' => 'Dog deleted successfully'
        ], 200);
    }
}
