<?php

namespace App\Repositories;

use App\Models\Post;
use App\Interfaces\PostReadInterface;
use App\Interfaces\ModelReadInterface;
use App\Interfaces\PostWriteInterface;
use App\Interfaces\ModelWriteInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements ModelWriteInterface, ModelReadInterface
{

    public function __construct(protected Model $model) {}

    public function store(array $data): Model
    {
        return $this->model::create($data);
    }

    public function index(): array
    {
        return $this->model::latest()->paginate(10)->toArray();
    }

    public function show($model): Model
    {
        return $model;
    }
    public function update($model, array $data): Model
    {
        $model->update($data);
        return $model;
    }

    public function destroy($model): void
    {
        $model->delete();
    }
}
