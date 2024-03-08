<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class GetAll
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository){
        $this->repository = $repository;
    }

    public function handle()
    {
        return $this->repository->categoriesByOwner();
    }

}
