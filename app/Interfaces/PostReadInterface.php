<?php

namespace App\Interfaces;

use App\Models\Post;

interface PostReadInterface extends ModelReadInterface
{
    public function index(): array;
    public function show($id): Post;
}
