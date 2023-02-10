<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function setModel(Model $model);
    public function getModel();
    public function getMaxId();
    public function paginate($wheres, array $paginate = [], array $columns = [], array $withs = []);
    public function first(int $id, array $columns = ['*'], array $withs = []);
    public function findBy(array $condition);
    public function store(array $data, bool $withoutFiringEvents = false);
    public function storeMany(array $data, bool $withoutFiringEvents = false);
    public function update(Model $model, array $data, bool $withoutFiringEvents = false);
    public function updateOrCreate(array $params, array $data, bool $withoutFiringEvents = false);
    public function delete(Model $model, bool $withoutFiringEvents = false): ?bool;
    public function all($wheres, array $columns = [], array $withs = []);
    public function paginateOnlyTrash($wheres, array $paginate = [], array $columns = [], array $withs = []);
    public function firstWithTrash(int $id, array $columns = ['*'], array $withs = []);
    public function paginateOrderBy($wheres, array $paginate = [], array $columns = [], array $withs = [], string $order);
}
