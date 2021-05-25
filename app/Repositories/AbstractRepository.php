<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    public function __construct(
        protected Model $model
    ) {
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function find(int $id, array $relations = []): ?Model
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function get(int $id, array $columns = ['*'], array $relations = []): ?Collection
    {
        return $this->model->select($columns)->where(['id' => $id])->get();
    }

    public function create(array $data): ?Model
    {
        $model = $this->model->create($data);

        return $model->fresh();
    }

    public function update(int $id, array $data): bool
    {
        $model = $this->model->find($id);

        return $model->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }
}
