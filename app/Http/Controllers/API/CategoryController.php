<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/pro/api/categories",
     *     summary="Get list of categories with services",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="A list with categories and their services"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categories not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function index()
    {
        try {
            $categories = Category::with('services')->orderBy('created_at', 'desc')->get();

            if ($categories->isEmpty()) {
                return response()->json(['error' => 'Categories not found'], 404);
            }

            return response()->json($categories, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/pro/api/categories/{id}",
     *     summary="Get a category with its services by ID",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the category",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category details with services"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            // Retrieve the category with its associated services
            $category = Category::with('services')->findOrFail($id);

            return response()->json($category, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }
}
