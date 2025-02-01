<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSprayingRequest;
use App\Http\Requests\UpdateSprayingRequest;
use App\Http\Resources\SprayingResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\SprayingsService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class SprayingsController extends Controller
{
    /**
     * @var SprayingsService
     */
    protected $service;

    /**
     * @param SprayingsService $service
     */
    public function __construct(SprayingsService $service) {
        $this->service = $service;
    }

    /**
     * Returns list of Sprayings
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SprayingResource::collection($this->service->getMergedSprayings());
    }

    /**
     * Store a Spraying
     * @param StoreSprayingRequest $request
     * @return JsonResponse
     */
    public function store(StoreSprayingRequest $request): JsonResponse
    {
        $data = $request->only(['comment', 'date', 'products']);
        $data['created_by'] = 1; // adding this as a temporary solution since the authentication is not working properly
        $spraying = $this->service->createSpraying($data);
        return response()->json($spraying, Response::HTTP_CREATED);
    }

    /**
     * Update a Spraying
     * @param UpdateSprayingRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateSprayingRequest $request, $id): JsonResponse
    {
        $data = $request->only(['comment', 'date', 'products']);
        $spraying = $this->service->updateSpraying($id, $data);

        if (!$spraying) {
            return response()->json(['errors' => 'Spraying update failed'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['message' => 'Spraying updated successfully'], Response::HTTP_OK);
    }

    /**
     * Delete a Spraying
     * @param Request $data
     * @return JsonResponse
     */
    public function destroy(Request $data): JsonResponse
    {
        $spraying = $this->service->deleteSpraying($data->toArray());

        if (!$spraying) {
            return response()->json(['errors' => 'Spraying deleted failed'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['message' => 'Deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
