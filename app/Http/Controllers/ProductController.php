<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Product::class);

        $products = $this->productService->list();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        Gate::authorize('create', Product::class);
        $product = $this->productService->store($request);

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        Gate::authorize('view', Product::class);

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        Gate::authorize('update', Product::class);
        $product = $this->productService->update($request, $product);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete', Product::class);

        $this->productService->destroy($product);

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
