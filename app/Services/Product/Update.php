<?php

namespace App\Services\Product;

use App\Exceptions\Category\CategoryNotFoundException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\ProductRepository;

class Update
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository){
        $this->repository = $repository;
    }

    public function handle($id, UpdateProductRequest $request)
    {
        $requestValidated = (object)$request->validated();

        $product = $this->repository->productExisting($id);

        if($product){
            $product = $this->repository->productUpdateValidation($product,
                $requestValidated);
        } else {
            throw new ProductNotFoundException($id);
        }

        return $product;
    }
}
