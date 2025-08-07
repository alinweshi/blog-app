<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Interfaces\PostReadInterface;
use App\Interfaces\PostWriteInterface;

class PostWriteService implements PostWriteInterface
{
    public function __construct(protected PostRepository $postRepository) {}
    public function store(array $data): Post
    {
        return $this->postRepository->store($data);
    }

    public function update($post, array $data): Post
    {
        return $this->postRepository->update($post, $data);
    }
    public function destroy($post): void
    {
        $this->postRepository->destroy($post);
    }
}
