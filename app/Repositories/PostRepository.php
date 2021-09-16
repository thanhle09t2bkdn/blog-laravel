<?php


namespace App\Repositories;


use App\Models\Post;
use Illuminate\Support\Facades\DB;

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
        'author' => ['column' => 'users.name', 'operator' => 'like'],
    ];

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function searchFromRequest($request)
    {
        $query = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.author_id')
            ->select([
                'posts.*',
                'users.name as author',
                'users.email',
            ]);
        $attributes = $request->all(array_keys($this->fieldSearchable));
        $condition = 'where';

        foreach ($attributes as $field => $value) {
            if ($value !== null) {
                $dataSearch = $this->getDataSearch($field);
                $column = $dataSearch['column'];
                $operator = $dataSearch['operator'];
                $type = $dataSearch['type'];

                if ($operator === 'in') {
                    $value = is_string($value) ? explode(",", $value) : $value;
                    $value = array_filter($value, function ($element) {
                        return !(is_null($element) || $element === '');
                    });
                    if ($value) {
                        $query = $query->{$condition . 'In'}($column, $value);
                    }
                } else {
                    if ($type === 'date') {
                        $query = $query->{$condition . 'Date'}($column, $operator, $value);
                    } else {
                        if ($operator === 'like') {
                            $value = '%' . $value . '%';
                        }
                        $query = $query->$condition($column, $operator, $value);
                    }
                }
            }
        }
        return $query->paginate();
    }

}
