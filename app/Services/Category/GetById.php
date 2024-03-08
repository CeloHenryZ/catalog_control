<?php

namespace App\Services\Category;

use App\Repositories\CategoryRepository;

class GetById
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository){
        $this->repository = $repository;
    }

    public function handle($id)
    {
        return $this->repository->find($id);
    }
}
