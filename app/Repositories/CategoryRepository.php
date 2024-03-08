<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryRepository extends AbstractRepository
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
        parent::__construct($category);
    }

    public function categoriesByOwner()
    {
        return $this->category->where(['owner_id' => Auth::user()->id])->get();
    }

    public function categoryExisting($id)
    {
        return $this->category->find($id);
    }

    public function categoryUpdateValidation($category, $request)
    {
        $category->title = $request->input('title', $category->title);
        $category->description = $request->input('description', $category->description);
        $category->save();

        return $category;
    }
}
