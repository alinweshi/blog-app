<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Users</h5>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Add User
        </a>
    </div>

    <div class="card-body">
        <!-- Filters -->
        <form class="row g-2 align-items-center mb-4" wire:submit.prevent>
            <div class="col-md-4">
                <input type="text" wire:model.live.debounce.500ms="query" class="form-control"
                    placeholder="Search name, username or email">
            </div>



            <div class="col-md-2">
                <select wire:model.live="perPage" class="form-select">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-outline-secondary w-100" wire:click="resetFilters">
                    <i class="fas fa-undo me-1"></i> Reset
                </button>
            </div>
        </form>

        <!-- Active Filters Display -->
        @if ($this->hasActiveFilters())
            <div class="mb-3">
                <small class="text-muted">Active filters:</small>
                <div class="d-flex flex-wrap gap-1 mt-1">
                    @if ($query)
                        <span class="badge bg-info">
                            Search: {{ $query }}
                            <button type="button" class="btn-close btn-close-white ms-1" wire:click="$set('query', '')"
                                style="font-size: 0.7em;"></button>
                        </span>
                    @endif
                    @if ($status !== '')
                        <span class="badge bg-info">
                            Status: {{ $status ? 'Active' : 'Inactive' }}
                            <button type="button" class="btn-close btn-close-white ms-1"
                                wire:click="$set('status', '')" style="font-size: 0.7em;"></button>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th class="no-export">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('user.posts', $user) }}" class="btn btn-info btn-sm">Posts</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-user-slash fa-3x mb-3"></i>
                                <p class="mb-2">No users found.</p>
                                @if ($query || $status !== '')
                                    <button wire:click="resetFilters" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-times me-1"></i> Clear filters
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                    @if ($query || $status !== '')
                        <span class="text-info">(filtered)</span>
                    @endif
                </div>
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
