<?php


namespace App\Repositories;


use App\Models\Post;

class PostRepository extends BaseRepository
{
    /**
     * Attribute searchable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'id' => ['column' => 'posts.id', 'operator' => '='],
        'title' => ['column' => 'posts.title', 'operator' => 'like'],
    ];

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

}
