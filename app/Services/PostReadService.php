<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Interfaces\PostReadInterface;
use App\Interfaces\PostWriteInterface;

class PostReadService implements PostReadInterface
{
    public function __construct(protected PostRepository $postRepository) {}

    public function index(): array
    {
        return $this->postRepository->index();
    }
    public function show($id): Post
    {
        return $this->postRepository->show($id);
    }
}
