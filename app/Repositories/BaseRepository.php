<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public const DEFAULT_PER_PAGE = 10;
    public const MAX_PER_PAGE     = 30;

    protected $model;

    /**
     * @param Model $model
     *
     * @return void
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }


    /**
     * @return int
     */
    public function getMaxId(): int
    {
        return $this->getModel()->max('id') ?? 0;
    }


    /**
     * @param array $params
     * @param array $paginate
     * @param array $columns
     * @param array $withs
     * @param mixed $wheres
     *
     * @return mixed
     */
    public function paginate($wheres, array $paginate = ['page' => 1], array $columns = [], array $withs = [])
    {
        $tableName = $this->getModel()->getTable();

        if (!$columns) {
            $columns = [$tableName.'.*'];
        }

        return $this->getModel()
            ->select($columns)
            ->where($wheres)
            ->with($withs)
            ->paginate(min($paginate['per_page'] ?? self::DEFAULT_PER_PAGE, self::MAX_PER_PAGE));
    }


    /**
     * @param int   $id
     * @param array $columns
     * @param array $withs
     *
     * @return mixed
     */
    public function first(int $id, array $columns = ['*'], array $withs = [])
    {
        return $this->getModel()->select($columns)->where(['id' => $id])->with($withs)->first();
    }

    /**
     * @param array $condition
     *
     * @return mixed
     */
    public function findBy(array $condition)
    {
        return $this->getModel()->where($condition)->get();
    }

    /**
     * @param array $data
     * @param bool  $withoutFiringEvents
     *
     * @return mixed
     */
    public function store(array $data, bool $withoutFiringEvents = false)
    {
        if ($withoutFiringEvents) {
            return $this->getModel()->withoutEvents(function () use ($data) {
                return $this->getModel()->create($data);
            });
        }

        return $this->getModel()->create($data);
    }

    /**
     * @param array $data
     * @param bool  $withoutFiringEvents
     *
     * @return mixed
     */
    public function storeMany(array $data, bool $withoutFiringEvents = false)
    {
        if ($withoutFiringEvents) {
            return $this->getModel()->withoutEvents(function () use ($data) {
                return $this->getModel()->insert($data);
            });
        }

        return $this->getModel()->insert($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @param bool  $withoutFiringEvents
     *
     * @return bool|int
     */
    public function update(Model $model, array $data, bool $withoutFiringEvents = false)
    {
        if ($withoutFiringEvents) {
            return $this->getModel()->withoutEvents(function () use ($model, $data) {
                return $model->update($data);
            });
        }

        return $model->update($data);
    }

    /**
     * @param array $params
     * @param array $data
     * @param bool  $withoutFiringEvents
     *
     * @return mixed
     */
    public function updateOrCreate(array $params, array $data, bool $withoutFiringEvents = false)
    {
        if ($withoutFiringEvents) {
            return $this->getModel()->withoutEvents(function () use ($params, $data) {
                return $this->getModel()->updateOrCreate($params, $data);
            });
        }

        return $this->getModel()->updateOrCreate($params, $data);
    }

    /**
     * @param Model $model
     * @param bool  $withoutFiringEvents
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $model, bool $withoutFiringEvents = false): ?bool
    {
        if ($withoutFiringEvents) {
            return $this->getModel()->withoutEvents(function () use ($model) {
                return $model->delete();
            });
        }

        return $model->delete();
    }

    public function all($wheres = null, array $columns = [], array $withs = [])
    {
        $tableName = $this->getModel()->getTable();

        if (empty($columns)) {
            $columns = [$tableName.'.*'];
        }

        return $this->getModel()
            ->select($columns)
            ->with($withs)
            ->where($wheres)
            ->get();
    }

    public function paginateOnlyTrash($wheres, array $paginate = ['page' => 1], array $columns = [], array $withs = [])
    {
        $tableName = $this->getModel()->getTable();

        if (!$columns) {
            $columns = [$tableName.'.*'];
        }

        return $this->getModel()
            ->select($columns)
            ->where($wheres)
            ->with($withs)
            ->onlyTrashed()
            ->paginate(min($paginate['per_page'] ?? self::DEFAULT_PER_PAGE, self::MAX_PER_PAGE));
    }

    /**
     * @param int   $id
     * @param array $columns
     * @param array $withs
     *
     * @return mixed
     */
    public function firstWithTrash(int $id, array $columns = ['*'], array $withs = [])
    {
        return $this->getModel()->select($columns)->where(['id' => $id])->with($withs)->withTrashed()->first();
    }

    /**
     * @param array $params
     * @param array $paginate
     * @param array $columns
     * @param array $withs
     * @param mixed $wheres
     * @param mixed $orderBy
     *
     * @return mixed
     */
    public function paginateOrderBy($wheres, array $paginate = ['page' => 1], array $columns = [], array $withs = [], string $orderBy)
    {
        $tableName = $this->getModel()->getTable();

        if (!$columns) {
            $columns = [$tableName.'.*'];
        }

        return $this->getModel()
            ->select($columns)
            ->where($wheres)
            ->with($withs)
            ->orderBy($orderBy)
            ->paginate(min($paginate['per_page'] ?? self::DEFAULT_PER_PAGE, self::MAX_PER_PAGE));
    }
}
