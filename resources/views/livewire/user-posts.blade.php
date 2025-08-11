<div>
    <div class="row g-2 align-items-center mb-4">
        <div class="col-md-4">
            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                placeholder="Search post title or content">
        </div>
        {{-- <div class="col-md-2">
            <select wire:model="status" class="form-select">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div> --}}
        <div class="col-md-2">
            <select wire:model="perPage" class="form-select">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="button" class="btn btn-outline-secondary w-100" wire:click="resetFilters">
                <i class="fas fa-undo me-1"></i> Reset
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    {{-- <th>Status</th> --}}
                    <th>Created At</th>
                    <th class="no-export">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        {{-- <td>
                            <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </td> --}}
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <button wire:click="$emit('deletePost', {{ $post->id }})"
                                class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="fas fa-folder-open fa-3x mb-3"></i>
                            <p class="mb-2">No posts found for this user.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $posts->links() }}
</div>
