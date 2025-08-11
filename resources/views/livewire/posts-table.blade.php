<div>
    <!-- Search & Filters -->
    <div class="row g-2 align-items-center mb-4">
        <div class="col-md-4">
            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                placeholder="Search title or description">
        </div>
        <div class="col-md-2">
            <select wire:model.live="perPage" class="form-select">
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

    <!-- Posts Table -->
    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Created At</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($post->description, 80) }}</td>
                        <td>{{ $post->user?->first_name }} {{ $post->user?->last_name }}</td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="text-end">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye">show</i>
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit">edit</i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-folder-open fa-3x mb-3"></i>
                            <p class="mb-0">No posts found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    {{ $posts->links() }}
</div>
