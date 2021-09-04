<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

}
