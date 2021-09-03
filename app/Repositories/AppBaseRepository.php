<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;

abstract class AppBaseRepository extends BaseRepository
{
    /**
     * Retrieve first data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function firstWhere(array $where, array $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        $model = $this->model->first($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Update where
     *
     * @param array $where   Conditions to update.
     * @param array $columns Columns update.
     *
     * @return mixed
     * @throws RepositoryException Repository.
     */
    public function updateWhere(array $where, array $columns)
    {
        $this->applyScope();
        $this->applyCriteria();

        $this->applyConditions($where);

        $result = $this->model->update($columns);

        $this->resetModel();
        return $result;
    }

    /**
     * Update where id in ids
     *
     * @param string $field   Field.
     * @param array  $values  Array values contain fields.
     * @param array  $columns Columns to update.
     *
     * @return mixed
     * @throws RepositoryException Repository.
     */
    public function updateWhereIn(string $field, array $values, array $columns)
    {
        $this->applyScope();
        $this->applyCriteria();

        $result = $this->model->whereIn($field, $values)
            ->update($columns);

        $this->resetModel();
        return $result;
    }

    /**
     * Delete the specified model record from the database.
     *
     * @param array $ids
     *
     * @return boolean|null
     * @throws RepositoryException
     */
    public function deleteByIds(array $ids)
    {
        $this->applyScope();
        $this->applyCriteria();

        $result = $this->model->whereIn('id', $ids)
            ->delete();

        $this->resetModel();
        return $result;
    }

    /**
     * Insert to database
     *
     * @param array $data Data insert.
     *
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * Order by columns
     *
     * @param array $columns Columns.
     *
     * @return $this
     */
    public function orderByColumns(array $columns)
    {
        foreach ($columns as $column => $direction) {
            $this->orderBy($column, $direction);
        }

        return $this;
    }

    /**
     * Generate series
     *
     * @param string $from
     * @param string $to
     * @param string $step
     * @param string $format
     *
     * @return $this
     */
    public function fromGenerateSeries(string $from, string $to, string $step, string $format)
    {
        $this->model = $this->model->from(
            DB::raw("(
                SELECT to_char(
                    generate_series(
                        '" . $from . "' :: date,
                        '" . $to . "' :: date,
                        '" . $step . "' :: interval
                    ) :: date,
                    '" . $format . "'
                ) AS date
            ) AS dates")
        );

        return $this;
    }

    /**
     * Count results of repository
     *
     * @param string $column
     * @param array  $where
     *
     * @return integer
     * @throws RepositoryException
     */
    public function sum(string $column, array $where = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($where) {
            $this->applyConditions($where);
        }

        $result = $this->model->sum($column);

        $this->resetModel();
        $this->resetScope();

        return $result;
    }

    /**
     * Join table
     *
     * @param string      $table    Table to join.
     * @param mixed       $first    First column.
     * @param string|null $operator Operator.
     * @param string|null $second   Second column.
     *
     * @return AppBaseRepository
     */
    public function join(string $table, $first, string $operator = null, string $second = null)
    {
        $this->model = $this->model->join($table, $first, $operator, $second);

        return $this;
    }

    /**
     * Join table
     *
     * @param mixed $table    Table to join.
     * @param mixed $first    First column.
     * @param mixed $operator Operator.
     * @param mixed $second   Second column.
     *
     * @return AppBaseRepository
     */
    public function leftJoin($table, $first, $operator = null, $second = null)
    {
        $this->model = $this->model->leftJoin($table, $first, $operator, $second);

        return $this;
    }
}
