<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Product\Delete;
use App\Services\Product\GetAll;
use App\Services\Product\Store;
use App\Services\Product\Update;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(StoreProductRequest $request, Store $service)
    {
        $newProduct = $service->handle($request);
        return response()->json($newProduct, 200);
    }

    public function list(GetAll $service)
    {
        $products = $service->handle();
        return response()->json($products, 200);
    }

    public function update($id, UpdateProductRequest $request, Update $service)
    {
        $product = $service->handle($id, $request);
        return response()->json($product, 200);
    }

    public function delete($id, Delete $service)
    {
        $productDeleted = $service->handle($id);
        return response()->json($productDeleted, 200);
    }
}
