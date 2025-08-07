<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ModelReadInterface
{
    public function index(): array;
    public function show($model): Model;
}
