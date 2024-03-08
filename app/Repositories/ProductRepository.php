<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductRepository extends AbstractRepository
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
        parent::__construct($product);
    }

    public function productExisting($id)
    {
        return $this->product->find($id);
    }

    public function productsByOwner()
    {
       return $this->product->where(["owner_id" => Auth::user()->id])->first();
    }

    public function productUpdateValidation($product, $request)
    {
        $product->title = $request->input('title', $product->title);
        $product->description = $request->input('description', $product->description);
        $product->price = $request->input('price', $product->price);
        $product->save();

        return $product;
    }
}
