<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ModelWriteInterface
{
    public function store(array $data): Model;
    public function update($model, array $data): Model;
    public function destroy($model): void;
}
