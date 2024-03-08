<?php

namespace App\Services\Product;

use App\Adapters\Aws\AwsSns;
use App\Exceptions\Product\ProductNotFoundException;
use App\Repositories\ProductRepository;
use App\Services\ServiceBase;

class Delete extends ServiceBase
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct(new AwsSns());
    }

    public function handle($id)
    {
        if(!$this->repository->productExisting($id)){
            throw new ProductNotFoundException($id);
        }

        $product = $this->repository->find($id);

        if($product){
            $data['product_id'] = $product->id;
            $data['owner_id'] = $product->owner_id;

            $deleted = $product->delete();

            if($deleted) {
                $this->getAwsnSns()->publish(getenv('AWS_SNS_TOPIC_CATALOG_ARN'), $data);
            }

            return $deleted;
        }
    }
}
