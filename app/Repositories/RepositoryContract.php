<?php
namespace App\Repositories;

interface RepositoryContract
{
    public function makeModel();

    public function all();

    public function count();

    public function deleteById($id);

    public function deleteByIds(array $ids);

    public function first();

    public function get();

    public function getById($id);

    public function getByColumn($item, $column, array $columns = ['*']);

    public function limit($limit);

    public function orderBy($column, $value);

    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null);

    public function where($column, $value, $operator = '=');

    public function whereIn($column, $value);

    public function with($relations);

    public function wheres($closure);

    public function whereHas($relation, $closure);

    public function orWhere($closure);

    public function restore($id);

    public function forceDelete($id);

    public function onlyTrashed();

    public function search($searchData, $isSearchOr = false);

    function getDataSearch(string $field);

    public function searchFromRequest($request);
}
