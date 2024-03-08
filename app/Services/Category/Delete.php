<?php

namespace App\Services\Category;

use App\Adapters\Aws\AwsSns;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Repositories\CategoryRepository;
use App\Services\ServiceBase;

class Delete extends ServiceBase
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository){
        $this->repository = $repository;
        parent::__construct(new AwsSns());
    }

    public function handle($id)
    {
        if(!$this->repository->categoryExisting($id)){
            throw new CategoryNotFoundException($id);
        }
        $category = $this->repository->find($id);

        if($category){
            $data['category_id'] = $category->id;
            $deleted = $this->repository->delete($id);

            if($deleted){
                $this->getAwsnSns()->publish(getenv('AWS_SNS_TOPIC_CATALOG_ARN'), $data);
            }

            return [
                "status" => $deleted,
                "category" => $category
            ];
        }

    }
}
