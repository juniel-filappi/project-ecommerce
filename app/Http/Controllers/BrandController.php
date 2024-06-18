<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
    public function __construct(
        protected BrandService $brandService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Brand::class);
        $brands = $this->brandService->list();

        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        Gate::authorize('create', Brand::class);
        $brand = $this->brandService->store($request);

        return response()->json($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        Gate::authorize('view', $brand);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        Gate::authorize('update', $brand);
        $brand = $this->brandService->update($request, $brand);

        return response()->json($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        Gate::authorize('delete', $brand);
        $this->brandService->destroy($brand);

        return response()->json(['message' => 'Brand deleted successfully.']);
    }
}
