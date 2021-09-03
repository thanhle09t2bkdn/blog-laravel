<?php

namespace App\Criteria;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;

class SearchCriteria extends Criteria
{

    /**
     * Filter
     *
     * @var array
     */
    private $filter;

    /**
     * Field searchable
     *
     * @var array
     */
    private $fieldSearchable;

    /**
     * Constructor.
     *
     * @param array $filter          Filters.
     * @param array $fieldSearchable Field searchable.
     *
     * @return void
     */
    public function __construct(array $filter, array $fieldSearchable)
    {
        $this->filter = $filter;
        $this->fieldSearchable = $fieldSearchable;
    }

    /**
     * Apply criteria in query repository
     *
     * @param mixed               $model      Model.
     * @param RepositoryInterface $repository Repository.
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $this->search($model, $this->filter);
    }

    /**
     * Search by basic where clause to the query.
     *
     * @param mixed $model      Model.
     * @param mixed $searchData Data to search.
     * @param bool  $isSearchOr Search "or".
     *
     * @return mixed
     */
    public function search($model, $searchData, bool $isSearchOr = false)
    {
        $condition = $isSearchOr ? 'orWhere' : 'where';

        foreach ($searchData as $field => $value) {
            if ($value !== null) {
                $dataSearch = $this->getDataSearch($field);
                $column = $dataSearch['column'];
                $operator = $dataSearch['operator'];
                $type = $dataSearch['type'];

                if ('in' == $operator) {
                    $value = is_string($value) ? explode(",", $value) : $value;
                    $value = array_filter($value, function ($element) {
                        return !(is_null($element) || $element === '');
                    });
                    if ($value) {
                        $model = $model->{$condition . 'In'}($column, $value);
                    }
                } else {
                    if ('date' == $type) {
                        $model = $model->{$condition . 'Date'}($column, $operator, $value);
                    } else {
                        if ('like' == $operator || 'ilike' == $operator) {
                            $value = '%' . $value . '%';
                        }
                        $model = $model->$condition($column, $operator, $value);
                    }
                }
            }
        }

        return $model;
    }

    /**
     * Get data search
     *
     * @param string $field Field.
     *
     * @return array
     */
    private function getDataSearch(string $field)
    {
        $searchable = $this->fieldSearchable[$field];
        if (!empty($searchable)) {
            $column = array_key_exists('column', $searchable) ? $searchable['column'] : $field;
            $operator = array_key_exists('operator', $searchable) ? $searchable['operator'] : '=';
            $type = array_key_exists('type', $searchable) ? $searchable['type'] : 'normal';
        } else {
            $column = $field;
            $operator = '=';
            $type = 'normal';
        }

        if ($type === 'raw') {
            $column = DB::raw($column);
        }

        if (isset($searchable['column_type'])) {
            $column = DB::raw($column . '::' . $searchable['column_type']);
        }

        return compact('column', 'operator', 'type');
    }
}
