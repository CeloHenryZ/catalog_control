<?php

namespace App\Services\Product;

use App\Adapters\Aws\AwsSns;
use App\Exceptions\Category\CategoryNotFoundException;
use App\Http\Requests\Product\StoreProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\Category\GetById as GetCategoryById;
use App\Services\ServiceBase;
use Illuminate\Support\Facades\Auth;

class Store extends ServiceBase
{
    private  GetCategoryById $categoryById;
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository, GetCategoryById $categoryById){

        $this->repository = $repository;
        $this->categoryById = $categoryById;
        parent::__construct(new AwsSns());
    }

    public function handle(StoreProductRequest $request)
    {
        $requestValidated = (object)$request->validated();

        $categoryId = $requestValidated->category_id;

        if(!$this->categoryById->handle($categoryId)){
            throw new CategoryNotFoundException($categoryId);
        }

        $newProduct = $this->repository->create([
            "title" => $requestValidated->title,
            "description" => $requestValidated->description,
            "price" => $requestValidated->price,
            "category_id" => $requestValidated->category_id,
            "owner_id" => Auth::user()->id
        ]);

        if($newProduct){
            $data['id'] = $newProduct->id;
            $data['title'] = $newProduct->title;
            $data['description'] = $newProduct->description;
            $data['owner_id'] = $newProduct->owner_id;
            $data['category_id'] = $newProduct->category_id;
            $data['type'] = 'product';

            $this->getAwsnSns()->publish(getenv('AWS_SNS_TOPIC_CATALOG_ARN'), $data);

            return $newProduct;

        }
    }
}
