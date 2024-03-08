<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Category\Delete;
use App\Services\Category\GetAll;
use App\Services\Category\Store;
use App\Services\Category\Update;
use GuzzleHttp\Middleware;

class CategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:api');
    }
    public function store(StoreCategoryRequest $request, Store $service)
    {
        $newCategory = $service->handle($request);
        return response()->json($newCategory, 200);
    }

    public function list(GetAll $service)
    {
        $categories = $service->handle();
        return response()->json($categories, 200);
    }

    public function update($id, UpdateCategoryRequest $request, Update $service)
    {
        $category = $service->handle($id, $request);
        return response()->json($category, 200);
    }

    public function delete($id, Delete $service)
    {
        $categoryDeleted = $service->handle($id);
        return response()->json($categoryDeleted, 200);
    }


}
