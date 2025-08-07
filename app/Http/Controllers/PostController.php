<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use App\Interfaces\PostReadInterface;
use App\Interfaces\PostWriteInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function __construct(protected PostReadInterface $postReadService, protected PostWriteInterface $postWriteService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->postReadService->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $this->postWriteService->store($request->validated());
            return response()->json(['message' => 'Post created successfully.'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to create post.'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $this->postReadService->show($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $this->postWriteService->update($post, $request->validated());
            return response()->json(['message' => 'Post updated successfully.'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to update post.'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $this->postWriteService->destroy($post);
    }
}
