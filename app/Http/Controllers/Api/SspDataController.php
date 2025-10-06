<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SspDataController extends Controller
{
    /**
     * Get sample SSP data
     * 
     * This endpoint returns sample data for the SSP module.
     * Requires authentication via Sanctum token.
     * 
     * @authenticated
     * @response 200 {
     *     "success": true,
     *     "data": {
     *         "message": "This is a sample SSP data response",
     *         "sample_data": [
     *             {"id": 1, "name": "Item 1", "value": 100},
     *             {"id": 2, "name": "Item 2", "value": 200},
     *             {"id": 3, "name": "Item 3", "value": 300}
     *         ]
     *     }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'message' => 'This is a sample SSP data response',
                'sample_data' => [
                    ['id' => 1, 'name' => 'Item 1', 'value' => 100],
                    ['id' => 2, 'name' => 'Item 2', 'value' => 200],
                    ['id' => 3, 'name' => 'Item 3', 'value' => 300],
                ]
            ]
        ]);
    }
}
