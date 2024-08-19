<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServiceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/pro/api/services",
     *     summary="Get list of all services",
     *     tags={"Services"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of all services"
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
            // Retrieve all services
            $services = Service::all();

            return response()->json($services, 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }


    /**
     * @OA\Get(
     *     path="/pro/api/services/{id}",
     *     summary="Get a service by ID",
     *     tags={"Services"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the service",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Service not found"
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
            // Retrieve the service by ID
            $service = Service::findOrFail($id);

            return response()->json($service, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Service not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }
}
