<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;

class GetAll
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository){
        $this->repository = $repository;
    }

    public function handle()
    {
        return $this->repository->productsByOwner();
    }
}
