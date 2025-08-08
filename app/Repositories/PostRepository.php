<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Interfaces\PostReadInterface;
use App\Interfaces\PostWriteInterface;

class PostRepository extends BaseRepository
{
    public function __construct(protected Post $post)
    {
        parent::__construct($post);
    }
    public function index(): array
    {
        return $this->post::with('user:id,first_name,last_name')->select('title', 'description', 'user_id')->where('user_id', '!=', auth('api')->user()->id)->orderBy('created_at', 'desc')->paginate(10)->through(function ($post) {
            $post->description = mb_strimwidth($post->description, 0, 512, '...');
            return $post;
        })->toArray();
    }
    // public function store(array $data): Post
    // {
    //     return $this->model->create($data);
    // }
    // public function index(): array
    // {
    //     return $this->model->all()->toArray();
    // }
    // public function show($id): Post
    // {
    //     return $this->model->findOrFail($id);
    // }
    // public function update(Post $post, array $data): Post
    // {
    //     $post->update($data);
    //     return $post;
    // }
    // public function destroy(Post $post): void
    // {
    //     $post->delete();
    // }
    // public function create(array $data): Post
    // {
    //     return $this->store($data);
    // }
}
