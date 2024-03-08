<?php

namespace App\Services\Category;

use App\Adapters\Aws\AwsSns;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Services\ServiceBase;
use Illuminate\Support\Facades\Auth;

class Store extends ServiceBase
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository){
        parent::__construct(new AwsSns());
        $this->repository = $repository;
    }

    public function handle(StoreCategoryRequest $request)
    {
        $requestValidated = (object)$request->validated();

        $newCategory = $this->repository->create([
            "title" => $requestValidated->title,
            "description" => $requestValidated->description,
            "owner_id" => Auth::user()->id
        ]);

        if($newCategory){
            $data['id'] = $newCategory->id;
            $data['title'] = $newCategory->title;
            $data['description'] = $newCategory->description;
            $data['owner_id'] = $newCategory->owner_id;
            $data['type'] = 'category';

            $this->getAwsnSns()->publish(getenv('AWS_SNS_TOPIC_CATALOG_ARN'), $data);
            return $newCategory;
        }
    }
}
