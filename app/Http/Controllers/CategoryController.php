<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Categories;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $categories = Categories::all();
            return response()->json($categories);
        } catch (Exception $e) {
            return response()->json(['Message' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $category = Categories::findOrFail($id);
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Message' => $e->getMessage()], 500);
        }
    }

    public function store(CategoryRequest $request) : jsonResponse
    {
        try {
            $validated = $request->validated();
            Categories::create($validated);
            return response()->json(['Message' => 'Category registered successfully']);
        } catch (Exception $e) {
            return response()->json(['Message' => $e->getMessage()], 500);
        }
    }

    public function update(CategoryRequest $request, int $id) : jsonResponse
    {
        try {
            $category = Categories::findOrFail($id);
            $validated = $request->validated();
            $category->update($validated);
            return response()->json(['Message' => 'Category updated successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Message' => 'Failed to remove Category', 'Details' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id) : jsonResponse
    {
        try {
            $category = Categories::findOrFail($id);
            $category->delete();
            return response()->json(['Message' => 'Category removed successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Message' => 'Failed to remove Category', 'Details' => $e->getMessage()], 500);
        }
    }
}
