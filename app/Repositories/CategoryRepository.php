<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    /**
     * Attribute searchable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'id' => ['column' => 'categories.id', 'operator' => '='],
        'title' => ['column' => 'categories.title', 'operator' => 'like'],
    ];

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

}
