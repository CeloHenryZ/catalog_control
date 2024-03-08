<?php

namespace App\Services\Category;

use App\Exceptions\Category\CategoryNotFoundException;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\ServiceBase;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class Update extends ServiceBase
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository){
        $this->repository = $repository;
    }

    public function handle($id, UpdateCategoryRequest $request)
    {
        $requestValidated = (object)$request->validated();

        $category = $this->repository->categoryExisting($id);

        if($category){
            $category = $this->repository->categoryUpdateValidation($category,
                $requestValidated)->toArray();

            $this->getAwsnSns()->publish(getenv('AWS_SNS_TOPIC_CATALOG_ARN'), $category);
        } else {
            throw new CategoryNotFoundException($id);
        }

        return $category;
    }

}
