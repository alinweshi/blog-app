<?php

namespace App\Interfaces;

use App\Models\Post;

interface PostWriteInterface extends ModelWriteInterface
{
    public function store(array $data): Post;
    public function update($post, array $data): Post;
    public function destroy($post): void;
}
